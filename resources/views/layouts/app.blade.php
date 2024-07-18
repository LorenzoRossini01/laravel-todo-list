<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>{{ env('APP_NAME', 'Laravel project') }} - @yield('title', 'My page') </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/js/app.js')

    @yield('css')
  </head>

  <body>
    <div class="wrapper d-flex">
        @include('partials.sidebar')

      <main class="flex-grow-1">
        @yield('main-content')
      </main>

    </div>

    @yield('js')
  </body>

</html>

<style>
      .wrapper{
        height: 100vh;
        overflow: hidden;

    }
</style>