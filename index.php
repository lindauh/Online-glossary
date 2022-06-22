<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link href="css/style.css" rel="stylesheet">
  <title>Document</title>
</head>

<body>
  <h1>User Panel</h1>

  <div class="container">
    <form id="search-form">
      <div class="mb-3">
        <label for="search">Type a word:</label>
        <input id="search" name="search" type="text" class="form-control">
      </div>

      <div class="mb-3">
        <label for="language">Choose language:</label>
        <select name="language_code" id="language" class="form-select">
          <option value="en">English</option>
          <option value="sk">Slovak</option>
        </select>
      </div>

      <div class="mb-3">
        <input id="translate-check" class="form-check-input me-1" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">Translate</label>
      </div>

      <div class="mb-3">
        <input id="full-text-check" class="form-check-input me-1" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">Full-Text search</label>
      </div>

      <div class="mb-3">
        <button type="button" id="search-button" class="btn btn-dark">Search</button>
      </div>

    </form>
  </div>

  <div class="container">
    <table id="result-table" class="table">
      <thead>
        <tr>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
</body>

<script src="script.js"></script>

</html>