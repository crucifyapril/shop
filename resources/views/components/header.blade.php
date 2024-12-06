@php use App\Enum\Roles; @endphp
<nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <a href="#" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Logo Shop"/>
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Logo Shop</span>
        </a>

        <div class="flex items-center lg:order-2">
            <a href="{{ route('cart.index') }}"
               class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium
               rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                Корзина
            </a>
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
