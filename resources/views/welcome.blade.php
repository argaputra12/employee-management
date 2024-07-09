<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/0b736e1e36.js" crossorigin="anonymous"></script>

    <!-- Datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" />

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body class="antialiased">
    <x-navbar />
    <div class="min-h-screen bg-gray-100 selection:bg-red-500 selection:text-white dark:bg-gray-900">
      <div class="mx-auto max-w-7xl py-10">
        <div class="w-full rounded-md bg-white">
          <div class="flex flex-col items-center justify-center space-y-6 p-6">
            <div class="flex w-full items-center justify-between">
              <h1 class="text-lg font-semibold">Insert Data</h1>
              <a href="{{ route('users.create') }}">
                <button
                  type="button"
                  class="mb-2 me-2 rounded-md bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                  Tambah Pegawai
                </button>
              </a>
            </div>

            <div class="relative flex w-full flex-col gap-3 overflow-x-auto">
              <input
                type="text"
                id="search"
                name="search"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="Search"
              />
              <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 rtl:text-right">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Gender</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Address</th>
                    <th class="px-6 py-3">Date of birth</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Salary</th>
                    <th class="px-6 py-3">Email</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                      <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $user->name }}
                      </th>
                      <td class="px-6 py-4">{{ $user->gender }}</td>
                      <td class="px-6 py-4">{{ $user->phone }}</td>
                      <td class="px-6 py-4">{{ $user->address }}</td>
                      <td class="px-6 py-4">{{ $user->date_of_birth }}</td>
                      <td class="px-6 py-4">{{ $user->role }}</td>
                      <td class="px-6 py-4">{{ $user->salary }}</td>
                      <td class="px-6 py-4">{{ $user->email }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div id="pagination" class="mt-4 flex justify-end">
                {{ $users->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script src="//cdn.datatables.net/2.0.8/js/dataTables.dataTables.min.js"></script>
  <script>
    // input search get data every keyup
    $('#search').on('keyup', function () {
      $value = $(this).val();
      $.ajax({
        type: 'get',
        url: '{{ route('api.users.search') }}',
        data: {
          search: $value,
        },
        success: function (datas) {
          // console.log(datas);
          datas.forEach((data) => {
            $('tbody').html('');
            $('tbody').append(`
                <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-800">
                <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                        ${data.name}
                      </th>
                      <td class="px-6 py-4">${data.gender}</td>
                      <td class="px-6 py-4">${data.phone}</td>
                      <td class="px-6 py-4">${data.address}</td>
                      <td class="px-6 py-4">${data.date_of_birth}</td>
                      <td class="px-6 py-4">${data.role}</td>
                      <td class="px-6 py-4">${data.salary}</td>
                      <td class="px-6 py-4">${data.email}</td>
                    </tr>`);
						$('#pagination').html('');
          });
        },
      });
    });
  </script>
</html>
