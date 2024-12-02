@php use App\Enum\Roles; @endphp
<nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="#" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Logo Shop"/>
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Logo Shop</span>
        </a>

        <div class="flex items-center lg:order-2">
            @guest
                <a href="{{ route('login') }}"
                   class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium
               rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    Вход в личный кабинет
                </a>
            @else
                <span class="text-gray-800 dark:text-white mr-4">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        Выйти
                    </button>
                </form>
            @endguest
            <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ route('index') }}"
                       class="block py-2 pr-4 pl-3 rounded lg:bg-transparent lg:p-0
              {{ request()->routeIs('index') ? 'text-primary-700 bg-primary-700' : 'text-gray-700 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:text-primary-700 dark:text-gray-400 dark:hover:text-white' }}">
                        Главная
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}"
                       class="block py-2 pr-4 pl-3 rounded lg:bg-transparent lg:p-0
              {{ request()->routeIs('products.index') ? 'text-primary-700 bg-primary-700' : 'text-gray-700 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:text-primary-700 dark:text-gray-400 dark:hover:text-white' }}">
                        Каталог товаров
                    </a>
                </li>
                @if(auth()->check() && auth()->user()->role->name === Roles::BUYER->value || auth()->check() && auth()->user()->role->name === Roles::MANAGER->value || auth()->check() && auth()->user()->role->name === Roles::OWNER->value)
                    <li>
                        <a href="{{ route('orders') }}"
                           class="block py-2 pr-4 pl-3 rounded lg:bg-transparent lg:p-0
              {{ request()->routeIs('orders') ? 'text-primary-700 bg-primary-700' : 'text-gray-700 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:text-primary-700 dark:text-gray-400 dark:hover:text-white' }}">
                            Мои заказы
                        </a>
                    </li>
                @endif
                @if(auth()->check() && auth()->user()->role->name === Roles::MANAGER->value || auth()->check() && auth()->user()->role->name === Roles::OWNER->value)
                    <li>
                        <a href="/admin"
                           class="block py-2 pr-4 pl-3 rounded lg:bg-transparent lg:p-0
              {{ request()->routeIs('orders') ? 'text-primary-700 bg-primary-700' : 'text-gray-700 hover:bg-gray-50 lg:hover:bg-transparent lg:hover:text-primary-700 dark:text-gray-400 dark:hover:text-white' }}">
                            Админ панель
                        </a>
                    </li>
                @endif
                <li>
                    <a href="#"
                       class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0
                       lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white
                       lg:dark:hover:bg-transparent dark:border-gray-700">
                        О нас
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
