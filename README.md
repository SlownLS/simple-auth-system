# Simple Authentification System
Simple authentication system is a pre-made authentication system to connect your users to your website. 

## General functions

User::SetDatabase(PDO $db) - Used to define the instance of your database

User::GetBy(string ...$args) - Used to retrieve a user's information

User::Create(string $username, string $email, string $password) - Used to register a user in the database

User::GetLocalInfo(string $key) - Used to retrieve information from the user's session.

## Login functions

User::IsLogged() - Whether the user is logged in.

User::Logout() - Used to log out the user

User::Login(string $username, string $password) - Used to log the user in.

User::Register(string $username, string $email, string $password, string $password_confirm) - Use to create a new user

## Notification functions

User::HasNotifications() - Whether the user has any notifications 

User::GetNotifications() - Used to retrieve user notifications

User::AddNotification(string $type, string $message) - Used to add a notification to the user

User::DestroyNotification(int $key) - Used to delete a notification to the user
