<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <script defer>
    async function wubook(data = {}) {
      let response = await fetch("https://wubook.revroo.io/push-notification", {
        method: "POST",
        body: data
      })

      // return response.json();
      console.log(response);
    }

    // wubook.then((data) => console.log(data));
  </script>

</head>

<body>

</body>

</html>