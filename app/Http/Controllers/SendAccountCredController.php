<?php

namespace App\Http\Controllers;

use App\Jobs\SendAccountCredJob;
use Google\Service\ServiceControl\Auth;

class SendAccountCredController extends Controller
{
    /**
     * Process CSV file and send emails to users
     *
     * @param string $file without extension
     * @return string
     */
    public function process(string $file)
    {
        // Role checking
        if (!auth()->user()->hasRole(ROLE_SUPER_ADMIN)) {
            return abort(403, 'You are not authorized to perform this action.');
        }

        // Load CSV file
        $csvPath = database_path('csv/' . $file . '.csv');
        $csvData = csv_to_array($csvPath);

        // Loop through users in CSV
        $batchSize = 25;
        foreach (array_chunk($csvData, $batchSize) as $batch) {
            foreach ($batch as $userData) {
                $user = [
                    'name' => $userData['name'],
                    'username' => $userData['username'],
                    'email' => $userData['email'],
                    'password' => $userData['password'],
                ];

                // Dispatch job
                SendAccountCredJob::dispatch($user);
            }

            // Delay for 5 seconds after every 25 emails
            sleep(5);
        }

        return "Emails are being sent.";
    }
}
