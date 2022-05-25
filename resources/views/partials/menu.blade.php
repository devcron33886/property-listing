<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('advert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.adverts.index") }}" class="nav-link {{ request()->is("admin/adverts") || request()->is("admin/adverts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fab fa-adversal">

                            </i>
                            <p>
                                {{ trans('cruds.advert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('plan_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.plans.index") }}" class="nav-link {{ request()->is("admin/plans") || request()->is("admin/plans/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-credit-card">

                            </i>
                            <p>
                                {{ trans('cruds.plan.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('subscription_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.subscriptions.index") }}" class="nav-link {{ request()->is("admin/subscriptions") || request()->is("admin/subscriptions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon far fa-credit-card">

                            </i>
                            <p>
                                {{ trans('cruds.subscription.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('loaction_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.loactions.index") }}" class="nav-link {{ request()->is("admin/loactions") || request()->is("admin/loactions/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-map-marker-alt">

                            </i>
                            <p>
                                {{ trans('cruds.loaction.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('electronic_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.electronics.index") }}" class="nav-link {{ request()->is("admin/electronics") || request()->is("admin/electronics/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bolt">

                            </i>
                            <p>
                                {{ trans('cruds.electronic.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('house_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/houses*") ? "menu-open" : "" }} {{ request()->is("admin/amenities*") ? "menu-open" : "" }} {{ request()->is("admin/house-galleries*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-home">

                            </i>
                            <p>
                                {{ trans('cruds.houseManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('house_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.houses.index") }}" class="nav-link {{ request()->is("admin/houses") || request()->is("admin/houses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-home">

                                        </i>
                                        <p>
                                            {{ trans('cruds.house.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('amenity_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.amenities.index") }}" class="nav-link {{ request()->is("admin/amenities") || request()->is("admin/amenities/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-accusoft">

                                        </i>
                                        <p>
                                            {{ trans('cruds.amenity.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('house_gallery_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.house-galleries.index") }}" class="nav-link {{ request()->is("admin/house-galleries") || request()->is("admin/house-galleries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-images">

                                        </i>
                                        <p>
                                            {{ trans('cruds.houseGallery.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('vehicle_listing_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/cars*") ? "menu-open" : "" }} {{ request()->is("admin/vehicle-infos*") ? "menu-open" : "" }} {{ request()->is("admin/car-media*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-car">

                            </i>
                            <p>
                                {{ trans('cruds.vehicleListing.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('car_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.cars.index") }}" class="nav-link {{ request()->is("admin/cars") || request()->is("admin/cars/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-car">

                                        </i>
                                        <p>
                                            {{ trans('cruds.car.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vehicle_info_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vehicle-infos.index") }}" class="nav-link {{ request()->is("admin/vehicle-infos") || request()->is("admin/vehicle-infos/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-info-circle">

                                        </i>
                                        <p>
                                            {{ trans('cruds.vehicleInfo.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('car_medium_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.car-media.index") }}" class="nav-link {{ request()->is("admin/car-media") || request()->is("admin/car-media/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-images">

                                        </i>
                                        <p>
                                            {{ trans('cruds.carMedium.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('land_or_plot_listing_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/land-or-plots*") ? "menu-open" : "" }} {{ request()->is("admin/land-media*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-plane-arrival">

                            </i>
                            <p>
                                {{ trans('cruds.landOrPlotListing.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('land_or_plot_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.land-or-plots.index") }}" class="nav-link {{ request()->is("admin/land-or-plots") || request()->is("admin/land-or-plots/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-plane-arrival">

                                        </i>
                                        <p>
                                            {{ trans('cruds.landOrPlot.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('land_medium_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.land-media.index") }}" class="nav-link {{ request()->is("admin/land-media") || request()->is("admin/land-media/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-images">

                                        </i>
                                        <p>
                                            {{ trans('cruds.landMedium.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/teams*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('team_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is("admin/teams") || request()->is("admin/teams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.team.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
                        <li class="nav-item">
                            <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "active" : "" }} nav-link" href="{{ route("admin.team-members.index") }}">
                                <i class="fa-fw fa fa-users nav-icon">
                                </i>
                                <p>
                                    {{ trans("global.team-members") }}
                                </p>
                            </a>
                        </li>
                    @endif
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>