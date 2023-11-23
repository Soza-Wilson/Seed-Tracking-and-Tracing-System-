$(document).ready(() => {
  $("#approve_order").click(() => {
    aprrove_order($("#order_id").val(), "approve");
  });

  $("#deny_order").click(() => {
    aprrove_order($("#order_id").val(), "deny");
  });

  $("#fetch_data").click(() => {
    $.ajax(settings).done(function (response) {
      console.log(response);
    });
  });
});
const aprrove_order = (order_id, action) => {
  let conformation = confirm("Are you sure ?");

  if (conformation == true) {
    let data = [order_id, action];

    $.post(
      "get_data.php",
      {
        approveOrder: data,
      },
      (data) => {
        alert(data)
        if (data == "approved") {
          alert("approved");
          window.history.back();
        }
      }
    );
  }
};

const settings = {
	async: true,
	crossDomain: true,
	url: 'https://weatherapi-com.p.rapidapi.com/history.json?q=London&dt=%3CREQUIRED%3E&lang=en',
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '82e78ad5fdmshe42ea74d9eb80e3p162a5djsn7a6ad8b9a7ec',
		'X-RapidAPI-Host': 'weatherapi-com.p.rapidapi.com'
	}
};

$.ajax(settings).done(function (response) {
	console.log(response);
});
// const sendAPIdata = () => {
//   fetch("'https://weatherapi-com.p.rapidapi.com/current.json",)
//     .then((res) => {
//       res.json();
//     })
//     .then((data) => {
//      console.log(data);
//     })
//     .catch((error) => {
//      console.log(error)
//     });
// };
