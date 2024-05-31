@php($menu = Menu::prepare())

<div class="navbar-left" v-bind:class="{'open': isMenuOpen}">
    <ul class="menubar">
        @foreach ($menu->items as $menuItem)
            @if ($menuItem['key'] == 'leads')

                <lead-left-menu-notification :is-menu="isMenuOpen"></lead-left-menu-notification>

                @push('scripts')
                    <script type="text/x-template" id="lead-left-menu-notification-template">
                        <li 
                            class="menu-item {{ Menu::getActive($menuItem) }}"
                            title="{{ $menuItem['name'] }}"
                            >
                            <a href="{{ $menuItem['url'] }}" class="count-menu">
                                <i class="icon sprite {{ $menuItem['icon-class'] }}"></i>
                                
                                <span class="menu-label">{{ $menuItem['name'] }}</span>

                                <span v-if="notificationsCount">
                                    <template v-if="isMenu">
                                        <div class="menu-label-count" v-text="notificationsCount"></div>
                                    </template>
                                    <template v-else>
                                        <div class="mobile-view" v-text="notificationsCount"></div>
                                    </template>
                                </span>
                            </a>

                            @if ($menuItem['key'] != 'configuration')
                                @if ($menuItem['key'] != 'settings' && count($menuItem['children']))
                                    <ul class="sub-menubar">
                                        @foreach ($menuItem['children'] as $subMenuItem)
                                            <li class="sub-menu-item {{ Menu::getActive($subMenuItem) }}">
                                                <a href="{{ count($subMenuItem['children']) ? current($subMenuItem['children'])['url'] : $subMenuItem['url'] }}">
                                                    <span class="menu-label">{{ $subMenuItem['name'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        </li>
                    </script>

                    <script>
                        Vue.component("lead-left-menu-notification", {
                            template: '#lead-left-menu-notification-template',

                            props: ['isMenu'],

                            data() {
                                return {
                                    notifications: null,
                                    notificationsCount: 0,
                                }
                            },

                            created() {
                                axios
                                    .get(`{{ route('admin.notification.recent') }}`, {
                                    })
                                    .then(response => {
                                        this.notifications = response.data.notifications;

                                        this.notificationsCount = response.data.count > 9 ? '9+' : response.data.count;
                                    });
                            },
                        });
                    </script>
                @endpush
                
            @else
                <li
                    class="menu-item {{ Menu::getActive($menuItem) }}"
                    title="{{ $menuItem['name'] }}"
                    @if (! count($menuItem['children'])
                        || $menuItem['key'] == 'settings'
                    )
                        v-tooltip.right="{
                            content: '{{ $menuItem['name'] }}',
                            classes: [isMenuOpen ? 'hide' : 'show']
                        }"
                    @endif
                >

                    <a href="{{ $menuItem['url'] }}">
                        <i class="icon sprite {{ $menuItem['icon-class'] }}"></i>
                        
                        <span class="menu-label">{{ $menuItem['name'] }}</span>
                    </a>

                    @if ($menuItem['key'] != 'configuration')
                        @if ($menuItem['key'] != 'settings' && count($menuItem['children']))
                            <ul class="sub-menubar">
                                @foreach ($menuItem['children'] as $subMenuItem)
                                    <li class="sub-menu-item {{ Menu::getActive($subMenuItem) }}">
                                        <a href="{{ count($subMenuItem['children']) ? current($subMenuItem['children'])['url'] : $subMenuItem['url'] }}">
                                            <span class="menu-label">{{ $subMenuItem['name'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </li>
            @endif
        @endforeach
    </ul>

    <div class="menubar-bottom" @click="toggleMenu">
        <span class="icon" v-bind:class="[isMenuOpen ? 'menu-fold-icon' : 'menu-unfold-icon']"></span>
    </div>
</div>