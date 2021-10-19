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
        'gm_veterinary_operations',
        'gm_vet_services',
        'other',
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

        if (!request()->file('document'))
        {
            return redirect()->route('user-import.index')->with([
                'status' => [
                    'message' => 'Please select file to import',
                    'type'    => 'danger',
                ]
            ]);
        }

        $data = (new UsersImport)->toArray(request()->file('document'))[0];

        foreach ($data as $datum)
        {
            foreach ($datum as $key => $value)
            {
                switch ($key)
                {
                    case 'clinic_name':
                        $this->clinic($datum);
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

                    case 'gm_veterinary_operations_email':
                        $this->user($data, 'gm_veterinary_operations');
                    break;

                    case 'gm_vet_services_email':
                        $this->user($data, 'gm_vet_services');
                    break;

                    case 'other_email':
                        $this->user($data, 'other');
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
    private function clinic(array $data) :void
    {

        if(!$data['clinic_name'])
        {
            return;
        }

        $clinic = Clinic::updateOrCreate([
            'name' => $data['clinic_name'],
        ],
        [
            'name'       => $data['clinic_name'],
            'deleted_at' => null,
        ]);

        ClinicManagers::where('clinic_id', '=', $clinic->id)->delete();

        $clinicManagers = [];

        foreach ($this->importManagers as $manager)
        {
            $users = $this->user($data, $manager);

            if($users)
            {
                foreach ($users as $user)
                {
                    $clinicManagers[] = [
                        'clinic_id'       => $clinic->id,
                        'user_id'         => $user->id,
                        'manager_type_id' => \array_search($manager, $this->managerTypes),
                    ];
                }

            }

        }

        ClinicManagers::insert($clinicManagers);
    }

    private function user(array $data, string $key)
    {
        $emails = $data[$key . '_email'] ?? null;

        if(!$emails)
        {
            return null;
        }

        $emails = \explode(',', $emails);
        $names  = explode(',', $data[$key . '_name']);

        $users  = [];

        $counter = 0;

        foreach($emails as $email)
        {
            $user  = User::where('email', '=', $email)->first();

            $name = $names[$counter];

            if($user)
            {
                $user->update([
                    'name' => $name,
                ]);

                $users[] = $user;
            }
            else
            {
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

                $users[] = $user;
            }

            $counter++;

        }

        return $users;
    }
}
