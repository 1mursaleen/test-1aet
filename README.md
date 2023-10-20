# Rank Tracker Test Task

The task is to create a keyword rank tracker. Users search for a keyword on Google, Google shows the top 100 results spread across multiple pages. We use an API to get the top 100 Google search results called DataForSEO.

Your task is to create a Laravel application with the following features:

- [x] User sign up/login system
- [x] Search dashboard where users can see their past searches or start a new one
- [x] New search screen allowing the user to enter a keyword,
  - [x] choose a country,
  - [x] choose the device (desktop or mobile),
  - [x] and set the number of search repetitions (how many times the search will be repeated)
  - [x] and start the search.
- [x] Send the details to the API
  - [x] and get the results back using their callback option.
  - [x] This will be repeated the same number of repetitions the user has already stated.
- [x] Store the results in the database.
- [x] Display the results
  - [x] on a graph
  - [x] and a table below it.
  - [x] The graph will show numbers from 1 to 100 (each representing a URL/website from the 100 results that Google returns) on the x-axis.
  - [x] On the y-axis, show the number of iterations.
  - [x] For example, if the first search result for the keyword "cake recipe" was a site called "makeacake.com," and for 20 repetitions, the site ranked 18 times at number one, then for one repetition, it ranked number 2, and for the last repetition, it ranked number 3. You will plot the points on the x-axis at position x = 1 for 18 repetitions. For the 19th repetition, you will plot at 2, and on the last repetition, you will plot at 3.

**Sign up with Data For SEO to obtain your API details:**
[Data For SEO](https://dataforseo.com/)

You will get a free account with $1 credit, which will be more than enough for the test.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
