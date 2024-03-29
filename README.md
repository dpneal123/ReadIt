# Read It

This web application is for users to share and read posts related to different subjects (forums).  Often this can be a replacement for a
blog for standalone forum

### Installation
1. Download/clone the code package
2. Composer install dependencies - 'composer install'
3. Copy .env.ci, create new file called .env
4. run 'php artisan key:generate' in terminal
5. Start web server PHP/MySQL
6. Create database for project
7. Update .env file with MySQL settings
8. Update .env file with APP_URL
    1. (default is http://localhost, may need to change to index URL when 'php artisan serve' e.g. http://127.0.0.1)
9. run 'php artisan migrate:fresh' in terminal
10. run 'php artisan dusk:install' in terminal
    1. delete ExampleTest.php from /tests/Browser as it will fail
11. Create 'Unit' folder in /tests
12. run 'npm run dev' in terminal
13. run 'php artisan serve' in terminal
14. (open new terminal instance as web service needs to be running) run 'php artisan test && php artisan dusk'
15. Test data can be replaced using 'php artisan migrate:fresh --seed'

### Features

The user is greeted by the dashboard page whether logged in or not.
If the current user is a guest they will not be able to use any other part of the website

Forums can be created by all users, but can only be edited/deleted by the user that created them
Posts can be created by all users, but can only be edited/deleted by the user

To see all current users' posts, you can select the dropdown on the top right and click 'My Posts'

The Posts tab contains all posts in reverse order, like a feed

The Forums tab contain all active forums, as well as forums that were created by the current user
(If only active forums were shown, it would be difficult to make a forum active)

If a user selects a forum from the forums tab they will be shown all posts written in that forum

The website now features 2FA to access the posts or forums when logging in - scrolling the limited posts on the dashboard does not require 2FA

Users can now up and down vote posts when logged in, as well as comment on posts and reply to comments

Features have been updated to use Livewire, meaning the UI can be updated without refreshing

New search function makes it easy to find interesting posts and forums

### Usage Instructions

![ReadIt Guest Home Screen](./ReadMeImages/Dashboard_Guest.png "ReadIt Home Screen")

The website opens on the dashboard view, because there is no user logged in there are **Login** and **Register** links in the top right

The functionality when not logged in is limited, the user will be redirected to the login screen if they try to open a post or click any link 
(other than **Dashboard** or **Register**)

![Login Page](./ReadMeImages/Login1.png "Login Page")

Click the **'New User?'** or **Register** links to create your own account

![Register](./ReadMeImages/RegisterScreen.png "Register Screen")

Enter name, email and password and press register

Open Google Authenticator app, add new QR Code and press Complete Registration

![Google Auth](./ReadMeImages/GA.png "Google Auth Screen")

![Logged In Dashboard View](./ReadMeImages/Dashboard_Auth.png "Logged in Dashboard View")

Now you have the ability to access all features, you can view a full post by clicking **Show**

![Post Show Page](./ReadMeImages/PostsView1.png "Post Show View")

You can create a new post by clicking **New Post** in the nav bar, or a New Post button in the posts and forums views

![Post Create Page](./ReadMeImages/Post_Create.png "Post Create View")

Create a new forum using the **New Forum** nav link or button

![Forum Create Page](./ReadMeImages/Forum_Create.png "Forum Create View")

Access your own posts by clicking on the dropdown in the top right

![User Dropdown](./ReadMeImages/AccountOptions.png "User Dropdown")

And clicking **My Posts**

![My Posts](./ReadMeImages/my_posts1.png "My Posts")

This shows the post that belong to the current user, and allow the posts to be edited or deleted.
These options can also be found in the posts view and within forums

![Posts Edit View](./ReadMeImages/Posts_Edit.png "Posts Edit View")

The **Posts** nav link takes the user to the Posts.View view with the 100 most recent posts

![Posts View](./ReadMeImages/Posts_View.png "Posts View")

Up or downvote posts by clicking the arrows

A new post or forum can be created by the nav bar links at the top, or the buttons at the top of this page, as well as a few others

The **Forums** nav link takes the user to Forums.View, which displays active forums as well as the forums belonging to the user

![Forums View](./ReadMeImages/Forums_View.png "Forums View")

This page allows the forums to be visited, by pressing the show button you can see all posts in that forum

![Forums Show](./ReadMeImages/Forms_Show.png "Forums Show")

The owner of the forum can also edit (name, description, active status) or delete the forum in this view

![Forums Edit](./ReadMeImages/Forums_Edit.png "Forums Edit")

This forum is currently inactive, as shown by the red background of the forum's card in the forums view and the unticked 'Active Forum' checkbox

To log out, click the **Log Out** link in the dropdown in the top right of the screen

### Future Plans

1. Forum creators can add admins/moderators to their forums
   1. Allow creators, admins & moderators to delete posts in said forum
   2. Creator/admin can edit forum info or mark as active/inactive
2. Allow forums (and by extension the posts in them) to be private until user is accepted to the forum
3. Events/notifications to keep track of the above
4. Update UI
5. Differentiate more between Dashboard, Posts.View and Forums.Show
