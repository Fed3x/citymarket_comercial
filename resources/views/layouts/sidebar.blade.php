<nav id="sidebar">
    <div class="sidebar-header mx-auto text-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            <b>{{ config('app.name', 'Laravel') }}</b>
        </a>
    </div>

    <ul class="list-unstyled components">
        <p>Dummy Heading</p>
        <li class="active items-list">
            <a href="#menuone" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
            <ul class="collapse list-unstyled items" id="menuone">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
            </ul>
        </li>
        <li class="items-list">
            <a href="#">About</a>
        </li>
        <li class="items-list">
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
            <ul class="collapse list-unstyled items" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
            </ul>
        </li>
        <li class="items-list">
            <a href="#">Portfolio</a>
        </li>
        <li class="items-list">
            <a href="#">Contact</a>
        </li>
    </ul>

</nav>