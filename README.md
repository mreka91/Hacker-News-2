# Hacker-News

<img src="https://media1.giphy.com/media/xT9IgzoKnwFNmISR8I/giphy.gif?cid=ecf05e47e50549f082ac5fb960dce794a105940e0d065481&rid=giphy.gif" width= "100%">

## Table of contents

- [General info](#general-info)
- [Technologies](#technologies)
- [Installation](#installation)
- [Testers](#testers)
- [Comments](#comments)
- [License](#license)

## General info

- This project is to create a social news website focusing on computer science, with a lot of requirements, example:
  create an account.
  Login system.
  Adding posts and comments.

- The content of project isn't logical data.
- The project should be public and, tested of two classmates .

## Technologies

Project is created with:

- PHP
- SQLite
- JavaScript
- HTML
- CSS

## Extra Features

added by [Reka Madarasz](https://github.com/mreka91)

- [x] As a user I am able to reply to comments, edit and delete them
- [x] As a user I am able to delete my profile, all my posts, comments, upvotes and replies

## Installation

In the terminal, use the command git clone, then paste the link from your clipboard :

```
$ git clone
```

Change directories to the new directory:

```
$ cd ~/Hacker-News/
```

Run a local server using the command line:

```
$ php -S localhost:8000

```

## Testers

The project was tested by:

- Simon Lindstedt
- Evelyn Fredin

## Comments

### Gilda Eklöf

- I would suggest creating functions for all SQL queries and keeping them in the `functions.php` file, instead of having long queries in other files such as `index.php` or `createComment.php`.
- Instead of having the `welcome.php` page, you could log in the user automatically after registration in `app/users/create.php`.
- `app/users/create.php:14` the `$emails` variable doesn't seem to have any purpose here.
- `app/users/create.php` users can create multiple accounts with the same email, since there's no function that checks that an email already exists.
- `editprofile.php:95` since the input for password confirmation has a `required` attribute, I can't edit information such as email and biography without having to also change my password. I would suggest having a separate form for changing the password.
- `app/users/profile.php:20` it seems like I can still change my password even if though the two passwords don't match. I would change `!=` to `!==` to check that the passwords are identical.
- Neither author nor username are displayed on posts, maybe add some sort of identitification info so you know who posted what.
- You could add `type="url"` in `createpost.php:21`, to prevent users from submitting other content than links in the url input.
- To prevent reloading of the page when liking/unliking posts, I suggest using JSON.
- `newestposts.php:19`, `mostpopular.php:19`, there doesn't seem to be a use for the `$users` variable here.

## License

MIT License. For more details https://github.com/Aseel88/Hacker-News/tree/main/resources
