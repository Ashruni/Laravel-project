<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('components.nav')

<table class="table-auto" style="margin-left:00px;margin-top:00px;width:500px;">
  <thead>
    <tr>
      <th class="bg-gray-200 border border-gray-400 px-4 py-2" colspan="2">WELCOME {{auth()->user()->name}}</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="border border-gray-400 px-4 py-2">Your ID</td>
      <td class="border border-gray-400 px-4 py-2">{{auth()->user()->id}}</td>
    </tr>

    <tr><td class="border border-gray-400 px-4 py-2">your Current Balance</td>
    <td class="border border-gray-400 px-4 py-2">{{$balance}}</td>

</tr>
  </tbody>
</table>
</body>
</html>



</body>
</html>
