<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SendinBlue\Client\Api\AccountApi;
use SendinBlue\Client\Api\ContactsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\CreateContact;
use GuzzleHttp;

class NewsletterController extends Controller
{
    private $contactsApiInstance;
    private $accountApiInstance;
    /**
     * Instantiate a new SettingsController instance.
     */
    public function __construct()
    {
        $apiKey = config('services.sendinblue.api');
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);

        $this->accountApiInstance = new AccountApi(
            new GuzzleHttp\Client(),
            $config
        );
        $this->contactsApiInstance = new ContactsApi(
            new GuzzleHttp\Client(),
            $config
        );
    }

    public function getAccount(){
        try {
            return $this->accountApiInstance->getAccount();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function createContact(Request $request){

        $this->validate($request, [
            'email' => 'required'
        ]);

        $contact = new CreateContact();
        $contact['email'] = $request->input('email');

        try {
            return $this->contactsApiInstance->createContact($contact);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
