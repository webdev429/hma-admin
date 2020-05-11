<div class="sidebar" data-color="rose" data-background-color="black"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
    <div class="logo">
        <a href="http://something.com" class="simple-text logo-mini">
            {{ __('H') }}
        </a>
        <a href="http://something.com" class="simple-text logo-normal">
            {{ __('HMA Project') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ auth()->user()->profilePicture() }}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>
                        {{ auth()->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini"> EP </span>
                                <span class="sidebar-normal"> Edit Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span class="sidebar-mini"> S </span>
                                <span class="sidebar-normal"> Settings </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item {{ ($menuParent == 'laravel' || $activePage == 'dashboard') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#laravelExample"
                    {{ ($menuParent == 'laravel' || $activePage == 'dashboard') ? ' aria-expanded="true"' : '' }}>
                    <i class="material-icons">desktop_mac</i>
                    <p>{{ __('System Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($menuParent == 'dashboard' || $menuParent == 'laravel') ? ' show' : '' }}"
                    id="laravelExample">
                    <ul class="nav">
                        @can('manage-users', App\User::class)
                        <li class="nav-item{{ $activePage == 'role-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('role.index') }}">
                                <i class="material-icons">verified_user</i>
                                <span class="sidebar-normal"> {{ __('Role Management') }} </span>
                            </a>
                        </li>
                        @endcan
                        @can('manage-users', App\User::class)
                        <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('user.index') }}">
                                <i class="material-icons">group</i>
                                <span class="sidebar-normal"> {{ __('User Management') }} </span>
                            </a>
                        </li>
                        @endcan
                        @can('manage-items', App\User::class)
                        <li class="nav-item{{ $activePage == 'tag-management' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('tag.index') }}">
                                <span class="sidebar-mini"> TM </span>
                                <span class="sidebar-normal"> {{ __('Tag Management') }} </span>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $menuParent == 'deal' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#dealManage"
                    {{ $menuParent == 'deal' ? ' aria-expanded="true"' : '' }}>
                    <i class="material-icons">receipt</i>
                    <p>{{ __('Deal Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ ($menuParent == 'deal' || $menuParent == 'characteristics') ? ' show' : '' }}"
                    id="dealManage">
                    <ul class="nav">
                        @can('manage-items', App\User::class)
                        <li class="nav-item{{ $activePage == 'deal_add' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('deal.add') }}">
                                <span class="sidebar-mini"> AD </span>
                                <span class="sidebar-normal"> {{ __('Add Deal') }} </span>
                            </a>
                        </li>
                        @endcan
                        @can('manage-items', App\User::class)
                        <li class="nav-item {{ $menuParent == 'characteristics' ? ' active' : '' }}">
                            <a class="nav-link" data-toggle="collapse" href="#characterManage">
                                <span class="sidebar-mini"> MLT </span>
                                <span class="sidebar-normal"> Basic Data Management
                                    <b class="caret"></b>
                                </span>
                            </a>
                            <div class="collapse {{ $menuParent == 'characteristics' ? ' show' : '' }}"
                                id="characterManage">
                                <ul class="nav">
                                    <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('category.index') }}">
                                            <span class="sidebar-mini"> CM </span>
                                            <span class="sidebar-normal"> {{ __('Category Management') }} </span>
                                        </a>
                                    </li>
                                    @can('manage-items', App\User::class)
                                    <li class="nav-item{{ $activePage == 'item-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('item.index') }}">
                                            <span class="sidebar-mini"> IM </span>
                                            <span class="sidebar-normal"> {{ __('Configuration Management') }} </span>
                                        </a>
                                    </li>
                                    @else
                                    <li class="nav-item{{ $activePage == 'item-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('item.index') }}">
                                            <span class="sidebar-mini"> IM </span>
                                            <span class="sidebar-normal"> {{ __('Items') }} </span>
                                        </a>
                                    </li>
                                    @endcan
                                    <li class="nav-item{{ $activePage == 'specific-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('specific.index') }}">
                                            <span class="sidebar-mini"> SM </span>
                                            <span class="sidebar-normal"> {{ __('Specific Data Management') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'make-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('make.index') }}">
                                            <span class="sidebar-mini"> MM </span>
                                            <span class="sidebar-normal"> {{ __('Make Management') }} </span>
                                        </a>
                                    </li>
                                    <li class="nav-item{{ $activePage == 'modeld-management' ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('modeld.index') }}">
                                            <span class="sidebar-mini"> MM </span>
                                            <span class="sidebar-normal"> {{ __('Model Management') }} </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
