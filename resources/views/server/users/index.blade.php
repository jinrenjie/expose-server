@extends('server.layouts.app')
@section('title')
    Users
@endsection

@section('content')
    <div class="flex flex-col py-8">
        <form>
            <div>
                <div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Add new user
                        </h3>
                    </div>
                    <div class="mt-6 sm:mt-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="username"
                                   class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Username
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-lg flex rounded-md shadow-sm">
                                    <input id="username"
                                           type="text"
                                           v-model="userForm.name"
                                           class="flex-1 border-gray-300 block w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                            <label for="token"
                                   class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Token
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-lg flex rounded-md shadow-sm">
                                    <input id="token"
                                           type="text"
                                           v-model="userForm.token"
                                           class="flex-1 border-gray-300 block w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                            <label for="can_specify_subdomains"
                                   class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Can specify custom subdomains
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input id="can_specify_subdomains"
                                               v-model="userForm.can_specify_subdomains"
                                               name="can_specify_subdomains"
                                               value="1" type="checkbox"
                                               class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
                                        <label for="can_specify_subdomains"
                                               class="ml-2 block text-sm leading-5 text-gray-900">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                            <label for="can_share_tcp_ports"
                                   class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Can share TCP ports
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="mt-2 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input id="can_share_tcp_ports"
                                               v-model="userForm.can_share_tcp_ports"
                                               name="can_share_tcp_ports"
                                               value="1" type="checkbox"
                                               class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"/>
                                        <label for="can_share_tcp_ports"
                                               class="ml-2 block text-sm leading-5 text-gray-900">
                                            Yes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
                            <label for="max_connections"
                                   class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                                Maximum Open Connections
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div class="max-w-lg flex rounded-md shadow-sm">
                                    <input id="max_connections"
                                           type="number"
                                           min="0"
                                           v-model="userForm.max_connections"
                                           class="flex-1 border-gray-300 block w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 border-t border-gray-200 pt-5">
                        <div class="flex justify-end">
                            <span class="ml-3 inline-flex rounded-md shadow-sm">
        <button type="submit"
                @click.prevent="saveUser"
                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
          Save
        </button>
      </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="max-w-lg flex rounded-md shadow-sm mb-8">
                <input id="search"
                       type="text"
                       v-model="search"
                       autocomplete="off"
                       placeholder="Search users"
                       class="flex-1 border-gray-300 block w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
            </div>

            <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full" v-if="users.length > 0">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Auth-Token
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Max Connections
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Custom Subdomains
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            TCP ports
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Created At
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white">
                    <tr v-for="user in users">
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                            @{ user.name }
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            @{ user.auth_token }
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            @{ user.max_connections }
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        <span v-if="user.can_specify_subdomains === 0">
                            No
                        </span>
                            <span v-else>
                            Yes
                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                        <span v-if="user.can_share_tcp_ports === 0">
                            No
                        </span>
                            <span v-else>
                            Yes
                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            @{ user.created_at }
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                            <a href="#" @click.prevent="deleteUser(user)"
                               class="pl-4 text-red-600 hover:text-red-900">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="flex items-center justify-end text-gray-900 p-4" v-if="paginated.current_page > 0">
                    <button
                            :disabled="paginated.previous_page == null"
                            v-on:click="getUsers(paginated.previous_page)"
                            type="button"
                            :class="(paginated.previous_page == null ? 'opacity-50 cursor-not-allowed' : '') + ' mr-3 py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out'"
                    >
                        Previous
                    </button>

                    <button
                            :disabled="paginated.next_page == null"
                            v-on:click="getUsers(paginated.next_page)"
                            type="button"
                            :class="(paginated.next_page == null ? 'opacity-50 cursor-not-allowed' : '') + ' py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out'"
                    >
                        Next
                    </button>
                </div>

                <div class="flex items-center justify-center text-gray-900 p-4" v-else>
                    <span class="text-xl">The expose server does not have any users yet.</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new Vue({
            el: '#app',

            delimiters: ['@{', '}'],

            data: {
                search: '',
                userForm: {
                    name: '',
                    token: '',
                    can_specify_subdomains: true,
                    can_share_tcp_ports: true,
                    max_connections: 0,
                    errors: {},
                },
                paginated: {!! json_encode($paginated) !!}
            },

            computed: {
                total: function () {
                    return this.paginated.total;
                },
                users: function () {
                    return this.paginated.users;
                }
            },

            watch: {
                search(val) {
                    if (val.length < 3) {
                        return;
                    }
                    this.getUsers(1);
                }
            },

            methods: {
                getUsers(page) {
                    fetch('/api/users?search=' + this.search + '&page=' + page)
                        .then((response) => {
                            return response.json();
                        }).then((data) => {
                        this.paginated = data.paginated;
                    });
                },

                deleteUser(user) {
                    fetch('/api/users/' + user.id, {
                        method: 'DELETE',
                    }).then((response) => {
                        return response.json();
                    }).then((data) => {
                        this.getUsers(1)
                    });
                },
                saveUser() {
                    fetch('/api/users', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(this.userForm)
                    }).then((response) => {
                        return response.json();
                    }).then((data) => {
                        if (data.user) {
                            this.userForm.name = '';
                            this.userForm.token = '';
                            this.userForm.can_specify_subdomains = true;
                            this.userForm.can_share_tcp_ports = true;
                            this.userForm.max_connections = 0;
                            this.userForm.errors = {};
                            this.users.unshift(data.user);
                        }
                        if (data.errors) {
                            this.userForm.errors = data.errors;
                        }
                    });
                }
            }
        })
    </script>
@endsection
