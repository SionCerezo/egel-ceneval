<ul id="sidebarnav">
    <li class="sidebar-item">
        <a class="sidebar-link sidebar-link" href="{{ route('alumno.home') }}" aria-expanded="false">
            <i data-feather="home" class="feather-icon"></i>
            <span class="hide-menu">Home</span>
        </a>
    </li>
    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">Postulaciones</span></li>

    {{-- Postulacion Actual --}}
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('alumno.postulacion') }}" aria-expanded="false">
            <i data-feather="file-text" class="feather-icon"></i>
            <span class="hide-menu">Actual</span>
        </a>
    </li>

    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-chat.html"
            aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                class="hide-menu">Historial</span></a></li>
    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
            aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                class="hide-menu">Calendar</span></a></li>

    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">Convocatorias</span></li>
    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
            aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                class="hide-menu">Activa </span></a>
        <ul aria-expanded="false" class="collapse  first-level base-level-line">
            <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><span
                        class="hide-menu"> Form Inputs
                    </span></a>
            </li>
            <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><span
                        class="hide-menu"> Form Grids
                    </span></a>
            </li>
            <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link"><span
                        class="hide-menu"> Checkboxes &
                        Radios
                    </span></a>
            </li>
        </ul>
    </li>
</ul>
