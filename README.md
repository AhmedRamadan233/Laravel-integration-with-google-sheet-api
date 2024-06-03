# Laravel Integration With Google Sheets API

## Setting Up Google Cloud

### Step 1: Google Cloud Console
Visit the Google Cloud Console to start setting up your project.
<a href="https://console.cloud.google.com">Click</a>

!open this 

Create a new project in the Google Cloud Console.
![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134011.png)

### Step 2: Create a New Project

!Create New Project

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134152.png)
### Step 3: Go to Library
Navigate to the library section of your Google Cloud project.

!Go to Library

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134244.png)

### Step 4: Enable APIs
Search for the required APIs and enable them for your project.

!Choose this one

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134335.png)

!Enable APIs

![Screenshot 2024-06-03 152622](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20152622.png)

------

## Configuring Credentials

### Step 1: Access Credentials
Go to the 'Credentials' section after enabling the necessary APIs.

!Credentials Section

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134523.png)

### Step 2: API Key
Ensure your API key is enabled for editing.

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134725.png)

!API Key Editing
![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20151423.png)

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20151453.png)

### Step 3: WebClient
Enable the WebClient and download the JSON file.

!WebClient JSON
![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20152043.png)

------------------------------------------

## Google Sheets Setup

### Step 1: Access Google Sheets
Go to your Google Sheet and ensure it is set to 'Share and Edit'.

!Google Sheets Share and Edit

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134838.png)

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20134933.png)

### Step 2: Sheet Name
Note that the name you see is the name of the paper, not the sheet.

!Paper Name

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20135109.png)

-------------------------

## Visual Studio Code Setup

### Step 1: JSON File
Place the downloaded JSON file into the storage directory of your Laravel project.

!JSON File in Storage 

### Step 2: Environment Variables
Set the following environment variables in your `.env` file:

```plaintext
GOOGLE_API_KEY=your-google-api-key
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_SERVICE_ACCOUNT_EMAIL=your-service-account-email
GOOGLE_SERVICE_ACCOUNT_JSON=your-json-file-name
GOOGLE_REDIRECT_URL=your-redirect-url
```
### Step 3: Composer Commands
Run the following commands to install the necessary package and publish the configuration:

```sh
composer require revolution/laravel-google-sheets
```
```sh
php artisan vendor:publish --provider="PulkitJalan\Google\GoogleServiceProvider" --tag="config"
```

### Step 4: Configuration File
Create a google.php file in the config folder with the following content:

```php
<?php

return [
    'application_name' => env('GOOGLE_APPLICATION_NAME', 'My Laravel Application'),
    'client_id'        => env('GOOGLE_CLIENT_ID'),
    'client_secret'    => env('GOOGLE_CLIENT_SECRET'),
    'redirect_uri'     => env('GOOGLE_REDIRECT_URL'),
    'scopes'           => [
        \Google\Service\Sheets::DRIVE,
        \Google\Service\Sheets::SPREADSHEETS,
    ],
    'access_type'      => 'offline',
    'approval_prompt'  => 'force',
    'developer_key'    => env('GOOGLE_API_KEY'),
    'service'          => [
        'enable' => true,
        'file'   => env('GOOGLE_SERVICE_ACCOUNT_JSON', storage_path('app/google-service-account.json')),
    ],
    'config'           => [],
];
```

### Step 5: Clear Configuration Cache
Remember to clear the configuration cache after making changes:

```sh
php artisan config:clear
```
```sh
php artisan config:cache
```
```sh
php artisan cache:clear
```
--------------

## Generate Process Google Sheets Data Controller

### Step 1: Retrieve Data
Get the $spreadsheetId from the URL of the sheet.

!Spread sheet Id

![](file:///C:/Users/w/Desktop/google%20sheet/Screenshot%202024-06-03%20154512.png)

**Define the `$ordersSheetName` as `orders!A2:F6`, which is the name of the sheet paper and its range.**


```php
use Revolution\Google\Sheets\Facades\Sheets;

public function index()
{
    $spreadsheetId = '1-ftqLjH8-rB2gNRro7uEq8j0j42oGqMvyKOw0v5__bE';
    $spreadsheetProductId = '14jNcQTMwAlRcx_JJpNszqovWzuBwrjKWvw4eZeotzJw';
    $ordersSheetName = 'orders!A2:f6';

    $productsSheetName = 'products!A2:D6';
    $orders = Sheets::spreadsheet($spreadsheetId)
        ->sheet($ordersSheetName)
        ->get();

    $products = Sheets::spreadsheet($spreadsheetProductId)
        ->sheet($productsSheetName)
        ->get();

    return response()->json(['orders' => $orders, 'products' => $products]);
}
```

