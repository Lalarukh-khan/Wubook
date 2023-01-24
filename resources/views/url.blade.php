<!DOCTYPE html>
<html>
  
<head>
    <title>Push Notification</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
  
<body>
    <!-- <h1 style="color:green;">
        GeeksforGeeks
    </h1> 
    <b>
        How To Get URL Parameters
        With JavaScript?
    </b>
  
    <p> Click on the button to get the url parameters in the console. </p>
  
    <button onclick="getParameters()"> Get URL parameters </button>
    <script>
    function getParameters() {
        let urlString = 
"https://www.example.com/login.php?a=GeeksforGeeks&b=500&c=Hello Geeks";
        let paramString = urlString.split('?')[1];
        let queryString = new URLSearchParams(paramString);
        for(let pair of queryString.entries()) {
            console.log("Key is:" + pair[0]);
            console.log("Value is:" + pair[1]);
        }
    }
    </script> -->
	<script>
// 		async function doRequest() {

// let url = 'https://wubook.revroo.io/push-notification';
// let data = {'name': 'John Doe', 'occupation': 'John Doe'};

// let res = await fetch(url, {
// 	method: 'POST',
// 	headers: {
// 		'Content-Type': 'application/json',
// 	},
// 	body: JSON.stringify(data),
// });

// if (res.ok) {

// 	// let text = await res.text();
// 	// return text;

// 	let ret = await res.json();
// 	return JSON.parse(ret.data);

// } else {
// 	return `HTTP error: ${res.status}`;
// }
// }

// doRequest().then(data => {
// console.log(data);
// });




const post = async (url, params) => {
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(params),
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        }
    })

    const data = await response.json()

    return data
}

// Then use it like so with async/await:
(async () => {
    const data = await post('https://wubook.revroo.io/push-notification')

    console.log(data)
})()



// const get = async (url, params) => {
//     const response = await fetch(url + '?' + new URLSearchParams(params))
//     const data = await response.json()

//     return data
// }

// // Call it with async:
// (async () => {
//     const data = await get('https://wubook.revroo.io/push-notification')

//     console.log(data)
// })()


const Http = new XMLHttpRequest();
const url='https://wubook.revroo.io/push-notification';
Http.open("POST", url);
Http.send();

Http.onreadystatechange = (e) => {
  console.log(Http.responseText)
}


async function postData() {
  try {
    const response = await axios.post("https://uniquetechsolution.co.in/simsmetacastBackend/public/api/v1/get-push-notification-response");
    console.log("Request successful!", JSON.stringify(response));
  } catch (error) {
    if (error.response) {
      console.log(error.response.status);
    } else {
      console.log(error.message);
    }
  }
}

postData();
	</script>
</body>
  
</html>