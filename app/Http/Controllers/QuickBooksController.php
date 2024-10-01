<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QuickBooksOnline\API\DataService\DataService;
// use QuickBooksOnline\API\Facades\Invoice;
use Illuminate\Support\Facades\Session;


class QuickBooksController extends Controller
{
    public function connect()
    {
        
        $dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => config('quickbooks.client_id'),
            'ClientSecret' => config('quickbooks.client_secret'),
            'RedirectURI' => config('quickbooks.redirect_uri'),
            'scope' => 'com.intuit.quickbooks.accounting',
            'baseUrl' => config('quickbooks.base_url')=== 'sandbox' ? "https://sandbox-quickbooks.api.intuit.com" : "https://quickbooks.api.intuit.com"
        ]);
        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();

        return redirect($authUrl);
    }

    public function callback(Request $request)
    {
        $dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => config('quickbooks.client_id'),
            'ClientSecret' => config('quickbooks.client_secret'),
            'RedirectURI' => config('quickbooks.redirect_uri'),
            'scope' => 'com.intuit.quickbooks.accounting',
            'baseUrl' => config('quickbooks.base_url')=== 'sandbox' ? "https://sandbox-quickbooks.api.intuit.com" : "https://quickbooks.api.intuit.com"
        ]);

        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $accessToken = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($request->code, $request->realmId);

        Session::put('quickbooks_access_token', $accessToken->getAccessToken());
        Session::put('quickbooks_refresh_token', $accessToken->getRefreshToken());
        Session::put('quickbooks_realm_id', $request->realmId);

        return redirect()->route('quickbooks.dashboard');
    }

    public function dashboard()
    {
        $dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => env('QUICKBOOKS_CLIENT_ID'),
            'ClientSecret' => env('QUICKBOOKS_CLIENT_SECRET'),
            'RedirectURI' => env('QUICKBOOKS_REDIRECT_URI'),
            'scope' => 'com.intuit.quickbooks.accounting',
            'baseUrl' => env('QUICKBOOKS_ENV') === 'sandbox' ? "https://sandbox-quickbooks.api.intuit.com" : "https://quickbooks.api.intuit.com",
            'accessTokenKey' => Session::get('quickbooks_access_token'),
            'refreshTokenKey' => Session::get('quickbooks_refresh_token'),
            'QBORealmID' => Session::get('quickbooks_realm_id'),
        ]);

        // Fetch some data
        $invoices = $dataService->FindAll('Invoice');

        return view('quickbooks.dashboard', compact('invoices'));
    }
}
