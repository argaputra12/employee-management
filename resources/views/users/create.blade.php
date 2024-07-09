<x-app-layout>
  <div class="mx-auto max-w-7xl py-10">
    <div class="w-full rounded-md bg-white">
      <div class="flex flex-col items-center justify-center space-y-6 p-6">
        <div class="flex w-full items-center justify-between">
          <h1 class="text-lg font-semibold">Insert Data</h1>
        </div>
        <div class="w-full">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="mx-auto max-w-sm" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
              <label for="image" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Image</label>
              <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" id="dropzone-file-label" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" name="image" accept="image/*" onchange="changeLabel()"/>
                </label>
            </div>
              @error('image')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
              <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required
              />
              @error('name')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="gender" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Gender</label>
              <select
                id="gender"
                name="gender"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
              >
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              @error('gender')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="phone" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Phone</label>
              <input
                type="text"
                id="phone"
                name="phone"
                value="{{ old('phone') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required
              />
              @error('phone')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Address</label>
              <input
                type="text"
                id="address"
                name="address"
                value="{{ old('address') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required
              />
              @error('address')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="date_of_birth" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Date of birth
              </label>
              <input
                type="text"
                id="date_of_birth"
                name="date_of_birth"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required
              />
            </div>
            <div class="mb-5">
              <label for="role" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Role</label>
              <select
                id="role"
                name="role"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
              >
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
              @error('role')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="salary" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Salary</label>
              <input
                type="number"
                id="salary"
                name="salary"
                value="{{ old('salary') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required
              />
              @error('salary')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                placeholder="name@email.com"
                required
              />
              @error('email')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-5">
              <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                Your password
              </label>
              <input
                type="password"
                id="password"
                name="password"
                value="{{ old('password') }}"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                required
              />
              @error('password')
                <div class="text-red-500">{{ $message }}</div>
              @enderror
            </div>
            <button
              type="submit"
              class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto"
            >
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function () {
      $('input[name="date_of_birth"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            format: 'YYYY-MM-DD' // Set the format visible to the user
        }
      });
    });

    // change dropzone label if file is selected
    function changeLabel() {
      const file = document.getElementById('dropzone-file');
      const label = document.getElementById('dropzone-file-label');
      const labelText = label.querySelector('p');
      const fileValue = file.value;
      if (fileValue) {
        labelText.innerHTML = file.files[0].name;
      }
    }

  </script>
</x-app-layout>
