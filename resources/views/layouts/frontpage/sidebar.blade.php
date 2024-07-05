<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row text-center">
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <ul class="list-unstyled menu-categories mt-2 " id="accordionExample">
            @can('agente.index')
                <li
                    class="menu {{ Route::currentRouteName() == 'reportes.index' || Route::currentRouteName() == 'reportes.show' || Route::currentRouteName() == 'reportes.edit' ? 'active' : '' }}">
                    <a href="{{ route('reportes.index') }}" aria-expanded="true" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                                id="Home-3--Streamline-Core" height="14" width="14">
                                <desc>Home 3 Streamline Icon: https://streamlinehq.com</desc>
                                <g id="home-3--home-house-roof-shelter">
                                    <path id="Subtract" fill="#000000" fill-rule="evenodd"
                                        d="M0.318182 6.0449C0.115244 6.23405 0 6.499 0 6.77642V12.5c0 0.8284 0.671573 1.5 1.5 1.5H6v-3c0 -0.5523 0.44772 -1 1 -1s1 0.4477 1 1v3h4.5c0.8284 0 1.5 -0.6716 1.5 -1.5V6.77642c0 -0.27742 -0.1152 -0.54237 -0.3182 -0.73152L7.3254 0.120372c-0.18725 -0.1604958 -0.46355 -0.160496 -0.6508 0L0.318182 6.0449Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Principal</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ Route::currentRouteName() == 'asignados' ? 'active' : '' }}">
                    <a href="{{ route('asignados') }}" aria-expanded="true" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48"
                                id="User-Switch-Account--Streamline-Plump" height="48" width="48">
                                <desc>User Switch Account Streamline Icon: https://streamlinehq.com</desc>
                                <g id="user-switch-account">
                                    <path id="Union" fill="#000000" fill-rule="evenodd"
                                        d="M5.686 11.58c0.048 -1.005 0.1 -1.898 0.155 -2.683 0.26 -3.784 3.168 -6.75 6.975 -7.034 2.553 -0.19 6.25 -0.363 11.238 -0.363 0.325 0 0.644 0 0.957 0.002a2.5 2.5 0 0 1 -0.022 5l-0.935 -0.002c-4.873 0 -8.445 0.17 -10.867 0.35 -1.303 0.097 -2.267 1.062 -2.358 2.39 -0.048 0.695 -0.095 1.483 -0.139 2.37 0.787 0.065 1.55 0.16 2.265 0.283 1.746 0.303 2.55 2.281 1.569 3.72 -1.574 2.306 -3.689 4.607 -4.753 5.72a2.452 2.452 0 0 1 -3.54 0.011c-1.103 -1.138 -3.348 -3.545 -4.824 -5.779 -0.962 -1.454 -0.109 -3.364 1.58 -3.661a26.42 26.42 0 0 1 2.699 -0.324ZM43.5 8a6.5 6.5 0 1 0 -10.648 5.004c-2.733 1.292 -4.776 3.837 -5.422 6.907 -0.309 1.463 0.939 2.59 2.283 2.59h14.458c1.344 0 2.592 -1.127 2.284 -2.59 -0.641 -3.043 -2.653 -5.569 -5.35 -6.872A6.488 6.488 0 0 0 43.5 8Zm-39 24a6.5 6.5 0 1 1 10.648 5.004c2.733 1.292 4.776 3.837 5.422 6.907 0.309 1.463 -0.939 2.59 -2.283 2.59H3.829c-1.344 0 -2.592 -1.127 -2.284 -2.59 0.641 -3.043 2.653 -5.569 5.35 -6.872A6.488 6.488 0 0 1 4.5 32Zm40.514 4.096a26.27 26.27 0 0 1 -2.7 0.324 128.661 128.661 0 0 1 -0.155 2.683c-0.26 3.785 -3.17 6.75 -6.976 7.034 -1.994 0.148 -4.685 0.286 -8.144 0.34a2.5 2.5 0 1 1 -0.078 -5c3.367 -0.052 5.96 -0.186 7.85 -0.326 1.305 -0.098 2.269 -1.063 2.36 -2.391 0.048 -0.695 0.095 -1.483 0.139 -2.37 -0.787 -0.065 -1.55 -0.16 -2.265 -0.283 -1.746 -0.303 -2.55 -2.281 -1.569 -3.72 1.574 -2.306 3.69 -4.607 4.753 -5.72a2.452 2.452 0 0 1 3.54 -0.011c1.103 1.138 3.348 3.545 4.824 5.779 0.962 1.454 0.109 3.364 -1.58 3.661Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Contratos</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('coordi.index')
                <li
                    class="menu {{ Route::currentRouteName() == 'coordinador.index' || Route::currentRouteName() == 'coordinador.show' ? 'active' : '' }}">
                    <a href="{{ route('coordinador.index') }}" aria-expanded="true" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48"
                                id="File-Report--Streamline-Core" height="48" width="48">
                                <desc>File Report Streamline Icon: https://streamlinehq.com</desc>
                                <g id="file-report">
                                    <path id="Subtract" fill="#000000" fill-rule="evenodd"
                                        d="M4.93488 1.5063085714285713C5.899337142857142 0.5418342857142857 7.2074742857142855 0 8.571428571428571 0H30.857142857142854c0.45466285714285715 0 0.8907085714285714 0.18061165714285712 1.2121714285714285 0.502104L44.06948571428571 12.502114285714285C44.390742857142854 12.823577142857141 44.57142857142857 13.259622857142856 44.57142857142857 13.714285714285714v29.142857142857142c0 1.3638857142857141 -0.5417142857142857 2.672228571428571 -1.5061714285714285 3.636685714285714S40.79245714285714 48 39.42857142857142 48h-30.857142857142854c-1.3639885714285713 0 -2.6720914285714286 -0.5417142857142857 -3.636548571428571 -1.5061714285714285C3.970422857142857 45.52937142857143 3.4285714285714284 44.22102857142857 3.4285714285714284 42.857142857142854v-37.714285714285715c0 -1.3639542857142857 0.5418514285714285 -2.6720777142857144 1.5063085714285713 -3.636548571428571Zm29.151771428571426 13.7232c0.8367771428571428 -0.8368457142857142 0.8367771428571428 -2.1936 0 -3.030445714285714 -0.8368457142857142 -0.8368457142857142 -2.1936 -0.8368457142857142 -3.030445714285714 0L25.71428571428571 17.540982857142854 22.086651428571425 13.913348571428571c-0.8368457142857142 -0.8368457142857142 -2.1936 -0.8368457142857142 -3.030445714285714 0l-5.142857142857142 5.142857142857142c-0.8368457142857142 0.8368457142857142 -0.8368457142857142 2.1936 0 3.030445714285714 0.8368457142857142 0.8368457142857142 2.1936 0.8368457142857142 3.030445714285714 0L20.57142857142857 18.459017142857142l3.6276342857142856 3.6276342857142856c0.8368457142857142 0.8368457142857142 2.1936 0.8368457142857142 3.030445714285714 0l6.857142857142857 -6.857142857142857ZM32.57142857142857 27h-17.142857142857142c-1.1834742857142857 0 -2.142857142857143 0.9593828571428571 -2.142857142857143 2.142857142857143s0.9593828571428571 2.142857142857143 2.142857142857143 2.142857142857143h17.142857142857142c1.1834742857142857 0 2.142857142857143 -0.9593828571428571 2.142857142857143 -2.142857142857143s-0.9593828571428571 -2.142857142857143 -2.142857142857143 -2.142857142857143Zm-17.142857142857142 8.571428571428571h17.142857142857142c1.1834742857142857 0 2.142857142857143 0.9593142857142857 2.142857142857143 2.142857142857143s-0.9593828571428571 2.142857142857143 -2.142857142857143 2.142857142857143h-17.142857142857142c-1.1834742857142857 0 -2.142857142857143 -0.9593142857142857 -2.142857142857143 -2.142857142857143s0.9593828571428571 -2.142857142857143 2.142857142857143 -2.142857142857143Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Reportes</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('coordi.show')
                <li
                    class="menu {{ Route::currentRouteName() == 'auditorias.index' || Route::currentRouteName() == 'auditorias.show' || Route::currentRouteName() == 'auditorias.create' ? 'active' : '' }}">
                    <a href="#Auditoria" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                                id="Clipboard-Check--Streamline-Core" height="14" width="14">
                                <desc>Clipboard Check Streamline Icon: https://streamlinehq.com</desc>
                                <g id="clipboard-check--checkmark-edit-task-edition-checklist-check-success-clipboard-form">
                                    <path id="Union" fill="#000000" fill-rule="evenodd"
                                        d="M5.5 0c-0.55228 0 -1 0.447716 -1 1v0.5c0 0.55229 0.44772 1 1 1h3c0.55229 0 1 -0.44771 1 -1V1c0 -0.552285 -0.44771 -1 -1 -1h-3ZM3.24997 1H2.75c-0.82843 0 -1.5 0.67157 -1.5 1.5v10c0 0.8284 0.67157 1.5 1.5 1.5h8.5c0.8284 0 1.5 -0.6716 1.5 -1.5v-10c0 -0.82843 -0.6716 -1.5 -1.5 -1.5h-0.5v0.5c0 1.24264 -1.00739 2.25 -2.25003 2.25h-3c-1.24264 0 -2.25 -1.00736 -2.25 -2.25V1ZM9.95 5.9c0.3314 0.24853 0.3985 0.71863 0.15 1.05l-3 4c-0.23883 0.3184 -0.68483 0.3948 -1.01603 0.174l-1.5 -1c-0.34464 -0.22973 -0.43777 -0.69538 -0.20801 -1.04003 0.22977 -0.34464 0.69542 -0.43777 1.04007 -0.20801l0.90966 0.60645L8.9 6.05c0.24853 -0.33137 0.71863 -0.39853 1.05 -0.15Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Auditoria</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="Auditoria" data-bs-parent="#accordionExample">
                        <li>
                            <a href="{{ route('auditorias.index') }}">Pendientes</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'auditorias.create' ? 'active' : '' }}">
                            <a href="{{ route('auditorias.create') }}">Revisados</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('admin.index')
                <li
                    class="menu {{ Route::currentRouteName() == 'personals.index' || Route::currentRouteName() == 'personals.edit' ? 'active' : '' }}">
                    <a href="#Personal" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                                id="User-Multiple-Group--Streamline-Core" height="14" width="14">
                                <desc>User Multiple Group Streamline Icon: https://streamlinehq.com</desc>
                                <g id="user-multiple-group--close-geometric-human-multiple-person-up-user">
                                    <path id="Union" fill="#000000" fill-rule="evenodd"
                                        d="M7.9799 3.815C7.9799 5.4387 6.6637 6.755 5.04 6.755S2.1 5.4387 2.1 3.815S3.4163 0.8751 5.04 0.8751S7.9799 2.1913 7.9799 3.815ZM5.04 7.735C2.3338 7.735 0.14 9.9288 0.14 12.6349C0.14 12.9055 0.3594 13.1249 0.63 13.1249H9.4499C9.7206 13.1249 9.9399 12.9055 9.9399 12.6349C9.9399 9.9288 7.7462 7.735 5.04 7.735ZM13.37 13.1249H11.094C11.1402 12.9697 11.165 12.8052 11.165 12.6349C11.165 10.6347 10.2062 8.8584 8.7231 7.7406C8.8016 7.7369 8.8806 7.735 8.96 7.735C11.6662 7.735 13.86 9.9288 13.86 12.6349C13.86 12.9055 13.6406 13.1249 13.37 13.1249ZM8.96 6.755C8.6643 6.755 8.3788 6.7114 8.1096 6.6301C8.7898 5.8888 9.205 4.9004 9.205 3.815S8.7898 1.7412 8.1096 0.9999C8.3788 0.9187 8.6643 0.8751 8.96 0.8751C10.5837 0.8751 11.9 2.1913 11.9 3.815S10.5837 6.755 8.96 6.755Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Usuarios</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="Personal" data-bs-parent="#accordionExample">
                        <li>
                            <a href="{{ route('personals.index') }}"> Personal Activo </a>
                        </li>
                    </ul>
                </li>
                <li class="menu {{ Route::currentRouteName() == 'informes' ? 'active' : '' }}">
                    <a href="#Informe" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                                id="Graph-Dot--Streamline-Core" height="14" width="14">
                                <desc>Graph Dot Streamline Icon: https://streamlinehq.com</desc>
                                <g id="graph-dot--product-data-bars-analysis-analytics-graph-business-chart-dot">
                                    <path id="Union" fill="#000000" fill-rule="evenodd"
                                        d="M1.5 0.75C1.5 0.335786 1.16421 0 0.75 0 0.335786 0 0 0.335786 0 0.75v12.5c0 0.4142 0.335786 0.75 0.75 0.75h12.5c0.4142 0 0.75 -0.3358 0.75 -0.75s-0.3358 -0.75 -0.75 -0.75H1.5V9.72028l2.2024 -2.35195c0.29094 0.16543 0.62747 0.25991 0.98608 0.25991 0.45353 0 0.87176 -0.15112 1.20709 -0.40576l1.42345 1.32764c-0.06603 0.19867 -0.10178 0.41117 -0.10178 0.63201 0 1.10597 0.89654 2.00247 2.00249 2.00247 1.10597 0 2.00247 -0.8965 2.00247 -2.00247 0 -0.51632 -0.1954 -0.98699 -0.5163 -1.34211l0.002 -0.00532 1.1586 -3.18236c1.0204 -0.09007 1.8205 -0.94695 1.8205 -1.99072 0 -1.10376 -0.8948 -1.998534 -1.9985 -1.998534 -1.1038 0 -1.99856 0.894774 -1.99856 1.998534 0 0.62669 0.28845 1.186 0.73986 1.55243L9.34856 7.18372c-0.04259 -0.00271 -0.08555 -0.00408 -0.12883 -0.00408 -0.33462 0 -0.65007 0.08207 -0.92731 0.22719L6.74886 5.96716c-0.02576 -0.02402 -0.05276 -0.04588 -0.08077 -0.06559 0.01203 -0.08868 0.01825 -0.17921 0.01825 -0.2712 0 -1.10339 -0.89447 -1.99786 -1.99786 -1.99786s-1.99787 0.89447 -1.99787 1.99786c0 0.18901 0.02625 0.37188 0.07529 0.54518 -0.00993 0.0095 -0.01966 0.01934 -0.02917 0.0295L1.5 7.52575V0.75Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Informes</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="Informe" data-bs-parent="#accordionExample">
                        <li>
                            <a href="{{ route('informes') }}"> Informes Generales</a>
                        </li>
                    </ul>
                </li>
                <li
                    class="menu {{ Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.show' || Route::currentRouteName() == 'roles.create' ? 'active' : '' }}">
                    <a href="#roles" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"
                                id="User-Multiple-Group--Streamline-Core" height="14" width="14">
                                <desc>User Multiple Group Streamline Icon: https://streamlinehq.com</desc>
                                <g id="user-multiple-group--close-geometric-human-multiple-person-up-user">
                                    <path id="Union" fill="#000000" fill-rule="evenodd"
                                        d="M7.9799 3.815C7.9799 5.4387 6.6637 6.755 5.04 6.755S2.1 5.4387 2.1 3.815S3.4163 0.8751 5.04 0.8751S7.9799 2.1913 7.9799 3.815ZM5.04 7.735C2.3338 7.735 0.14 9.9288 0.14 12.6349C0.14 12.9055 0.3594 13.1249 0.63 13.1249H9.4499C9.7206 13.1249 9.9399 12.9055 9.9399 12.6349C9.9399 9.9288 7.7462 7.735 5.04 7.735ZM13.37 13.1249H11.094C11.1402 12.9697 11.165 12.8052 11.165 12.6349C11.165 10.6347 10.2062 8.8584 8.7231 7.7406C8.8016 7.7369 8.8806 7.735 8.96 7.735C11.6662 7.735 13.86 9.9288 13.86 12.6349C13.86 12.9055 13.6406 13.1249 13.37 13.1249ZM8.96 6.755C8.6643 6.755 8.3788 6.7114 8.1096 6.6301C8.7898 5.8888 9.205 4.9004 9.205 3.815S8.7898 1.7412 8.1096 0.9999C8.3788 0.9187 8.6643 0.8751 8.96 0.8751C10.5837 0.8751 11.9 2.1913 11.9 3.815S10.5837 6.755 8.96 6.755Z"
                                        clip-rule="evenodd" stroke-width="1"></path>
                                </g>
                            </svg>
                            <span>Configuracion</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="roles" data-bs-parent="#accordionExample">
                        <li>
                            <a href="{{ route('roles.index') }}"> Roles </a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
</div>
