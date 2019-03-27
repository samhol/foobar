$(function() {
  console.log('wrgebrwge');
  $.getJSON("data/index.php", function (data) {
    var items = [];
    $.each(data, function (key, val) {
      items.push("<li id='" + key + "'>" + val + "</li>");
    });

    $("<ul/>", {
      "class": "my-new-list",
      html: items.join("")
    }).appendTo("#foo");
  });

});
