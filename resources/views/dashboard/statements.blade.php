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
    <table class="min-w-full divide-y divide-gray-200">
  <thead class="bg-gray-50">
    <tr>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deposits</th>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Withdrawals</th>
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">transfered to email</th>
    </tr>

  </thead>
  <tbody class="bg-white divide-y divide-gray-200">
    @foreach($statements as $statement)
    <tr>
      <td class="px-6 py-4 whitespace-nowrap">{{$statement->created_at}}</td>
      <td class="px-6 py-4 whitespace-nowrap">{{$statement->deposits}}</td>
      <td class="px-6 py-4 whitespace-nowrap">{{$statement->withdrawals}}</td>
      <td class="px-6 py-4 whitespace-nowrap">{{$statement->transfers}} - {{$statement->email}}</td>
    </tr>

    @endforeach
    <tr>
    <b><th scope="col" style="color:black" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th></b>
    <td class="px-6 py-4 whitespace-nowrap" style="color:black">{{$balances}}</td>
</tr>

    <!-- More rows... -->

  </tbody>
</table>


</body>
</html>
