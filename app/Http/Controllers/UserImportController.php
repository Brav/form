<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\User;
use Hackzilla\PasswordGenerator\Exception\CharactersNotFoundException;
use Hackzilla\PasswordGenerator\Exception\InvalidOptionException;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UserImportController extends Controller
{
    private $managerTypes;

    /**
     * Managers types from the excel file
     *
     * @var string[]
     */
    private $importManagers = [
        'practice_manager',
        'lead_vet',
        'regional_manager',
        'veterinary_manager',
        'general_manager',
    ];

    function __construct ()
    {
        $this->managerTypes = ClinicManagers::$managerTypes;
    }
    public function index()
    {
        return view('user-import/index');
    }

    public function import()
    {
        $data = (new UsersImport)->toArray(request()->file('document'))[0];

        foreach ($data as $datum)
        {
            foreach ($datum as $key => $value)
            {
                switch ($key)
                {
                    case 'clinic_name':
                        $this->clinic($value, $datum);
                        break;
                    case 'practice_manager_email':
                        $this->user($data, 'practice_manager');
                        break;
                    case 'lead_vet_email':
                            $this->user($data, 'lead_vet');
                            break;
                    case 'regional_manager_email':
                        $this->user($data, 'regional_manager');
                        break;
                    case 'veterinary_manager_email':
                        $this->user($data, 'veterinary_manager');
                        break;
                        case 'general_manager_email':
                    $this->user($data, 'general_manager');
                    break;
                }
            }
        }

        return redirect()->route('user-import.index')->with([
            'status' => [
                'message' => 'Data imported',
                'type'    => 'success',
            ]
        ]);
    }

    /**
     * Check if clinic exist, and if not create one and populate with managers
     *
     * @param string $clinicName Clinic Name
     * @param array $data Data
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws CharactersNotFoundException
     * @throws InvalidOptionException
     */
    private function clinic(string $clinicName, array $data) :void
    {
        $clinic = Clinic::where('name', '=', $clinicName)->first();

        if(!$clinic)
        {
            $clinic = Clinic::create([
                'name' => $data['clinic_name'],
            ]);
        }

        ClinicManagers::where('clinic_id', '=', $clinic->id)->delete();

        $clinicManagers = [];

        foreach ($this->importManagers as $manager)
        {
            $user = $this->user($data, $manager);

            if($user)
            {
                $clinicManagers[] = [
                    'clinic_id'       => $clinic->id,
                    'user_id'         => $user->id,
                    'manager_type_id' => \array_search($manager, $this->managerTypes),
                ];
            }

        }

        ClinicManagers::insert($clinicManagers);
    }

    private function user(array $data, string $key)
    {
        $email = $data[$key . '_email'] ?? null;

        if(!$email)
        {
            return null;
        }

        $user  = User::where('email', '=', $email)->first();

        $name = trim($data[$key . '_name']);

        if($user)
        {
            $user->update([
                'name' => $name,
            ]);
            return $user;
        }

        $generator = new ComputerPasswordGenerator();

        $password = $generator
        ->setUppercase()
        ->setLowercase()
        ->setNumbers()
        ->setSymbols(false)
        ->setLength(12)->generatePassword();

        $user = User::create([
            'email'    => $email,
            'name'     => $name === '' ? "Name Placeholder" : $name,
            'login'    => true,
            'password' => Hash::make($password),
        ]);

        \Mail::to($email)->send(new \App\Mail\NewAccount($user, $password));

        return $user;
    }
}
