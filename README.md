# Rank Tracker Test Task

The task is to create a keyword rank tracker. Users search for a keyword on Google, Google shows the top 100 results spread across multiple pages. We use an API to get the top 100 Google search results called DataForSEO.

Your task is to create a Laravel application with the following features:

- [ ] User sign up/login system
- [ ] Search dashboard where users can see their past searches or start a new one
- [ ] New search screen allowing the user to enter a keyword,
  - [ ] choose a country,
  - [ ] choose the device (desktop or mobile),
  - [ ] and set the number of search repetitions (how many times the search will be repeated)
  - [ ] and start the search.
- [ ] Send the details to the API
  - [ ] and get the results back using their callback option.
  - [ ] This will be repeated the same number of repetitions the user has already stated.
- [ ] Store the results in the database.
- [ ] Display the results
  - [ ] on a graph
  - [ ] and a table below it.
  - [ ] The graph will show numbers from 1 to 100 (each representing a URL/website from the 100 results that Google returns) on the x-axis.
  - [ ] On the y-axis, show the number of iterations.
  - [ ] For example, if the first search result for the keyword "cake recipe" was a site called "makeacake.com," and for 20 repetitions, the site ranked 18 times at number one, then for one repetition, it ranked number 2, and for the last repetition, it ranked number 3. You will plot the points on the x-axis at position x = 1 for 18 repetitions. For the 19th repetition, you will plot at 2, and on the last repetition, you will plot at 3.

**Sign up with Data For SEO to obtain your API details:**
[Data For SEO](https://dataforseo.com/)

You will get a free account with $1 credit, which will be more than enough for the test.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
