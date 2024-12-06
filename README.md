<h1 align=center>
	Laravel Auth0 Multi Tenancy Management 
</h1>

## This is deprecated now as since first creating this Auth0 improved their SDK to include comprheensive Admin API support.

## Intro

This package was built to sit alongside the main auth0 package. Unfortunately that package has limited management API capabilities / facades. This package aims to remedy that.

## Progress

So far the following items are working:

- Authentication
- User Management
- Branding Management
- Organization Management

##### As I complete other modules, they will be listed above. If anyone from Auth0 wishes to merge this extra functionality into the main package, please feel free to fork and extract what you need, all I ask is to be credited.

### Documentation Notes 

More comprehensive documentation will be written eventually, I'm working on this in my spare time, so you'll need ot bare with me.

For now i'll explain the simple premise. I've essentially created static functions for each endpoint on the API documentation.

### Data Formatting
Unless specified otherwise, all POST endpoints that require body data should be posted exactly as outlined in the corresponding documentation (you can post it as an associated array and the package will convert it to JSON). The same goes for query parameters, all is exactly as the documentation

### Authentication Setup
You will need a machine to machine application (client) set up within your auth0 tenant that has management api access. Ideally you should use an application that only accesses the management API, that way any tokens generated from these interactions will not eat into your M2M quote.

You can just set these in .env as follows:

````
AUTH0_MGMT_CLIENT_ID=
AUTH0_MGMT_CLIENT_SECRET=
AUTH0_MGMT_DOMAIN=
AUTH0_MGMT_AUDIENCE=
````

The reason for the slightly different env variables is that you may wish to use a separate application to authenticate your users and act as your API. Which is recommended as stated above due to token quotas.

## Examples

Once you have added the .env variables you should be good to go. When you make your first request, the package will automatically get a token using the above credentials and store it in cache. Any subsequent requests will not require this unless of course the token has expired, then the package will get a new token.

Each of the endpoint entities is available as an importable class. Given the generic nature of the class naming conventions, it seemed controversial to create these as pre-imported facades as they may conflict with other packages.

Once I have more time I will explore this, for now it's no harm to import the class.

### Get Users

````
<?php

use Lanos\Auth0MultiManagement\Modules\User

public function getUsers(){

    $users = User::get();
    
    // Alternatively you can apply query paramters as desired
    
    $queryParams = [
        "page" => 2,
        "per_page" => 20
    ];
    
    // This will get page 2 of the results with 20 per page
    $paginated = User::get($queryParams);

}

````

### Get User Organizations

Gets the tenants / organizations a user belongs to. Handy for multi tenant applications. Again, has the same pagination query param options.

````
<?php

import Lanos\Auth0MultiManagement\Modules\User

public function getUserOrganizations($userID){

    $userOrganizations = User::organizations($userID);
    
    // Alternatively you can apply query paramters as desired
    
    $queryParams = [
        "page" => 2,
        "per_page" => 20
    ];
    
    // This will get page 2 of the results with 20 per page
    $paginated = User::organizations($queryParams);

}

````

### Add Users To An Organization

````
<?php

import Lanos\Auth0MultiManagement\Modules\Organization

public function addUsesrToOrganization($organizationID){

    $user_ids = [
        "auth0|507f1f77bcf86cd799439020",
        "auth0|507f1f77bcf86cd198439125",
    ];

    $addUser = Organization::addMembers($organizationID, $user_ids);

    // THIS WILL ADD THE 2 ABOVE USER IDS TO THIS ORGANIZATION

}

````

## License

Please refer to [LICENSE.md](https://github.com/l4nos/laravel-auth0-multi-tenancy/blob/main/LICENSE) for this project's license.
