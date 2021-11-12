**Caution : This Package didn't Complete yet and it is in the Development Stage Please don't install it.**

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)


# laravel Email Verification
Verify user emails using verification __code__ instead of the verification using URL. it's safe enough and has a better user experience.

verify email with URL isn't a good experience for the User so I change it to __code__ verification

#### How to install and this 
for this package you need to install `laravel ui` and `fortify` for create Authentication system 

- First install from Composer
- Add the Service Provider below of the Fortify Package
- Run the laravel Migration
- Implements the User model to `BlackPanda\EmailVerification\Contracts\MustVerifyEmail`
- `use \BlackPanda\EmailVerification\MustVerifyEmail` Trait in User Model
- From `app/Providers/EventServiceProvider` change the `Registered` Listener to `\BlackPanda\EmailVerification\Listeners\SendEmailVerificationNotification::class`
- Well Done :)

------

This is a note for my self please don't care about it until I had a documentation for continue development :)

- everything until routes are ready tested and works
- Add a view for EmailVerification Form
- Add a method and Post Route to Controller for process the code and verify the email
- Great job 
