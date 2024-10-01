@extends('layout.master')

@section('content')
    <div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">
                        Calendar </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="../index.html" class="text-muted text-hover-primary">
                                Dashboard </a>
                        </li>

                        <li class="breadcrumb-item text-dark">
                            Calendar </li>

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->

                {{-- <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                    <a href="#" class="btn bg-body btn-color-gray-700 btn-active-primary me-4" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_invite_friends">
                        Invite Friends
                    </a>

                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_project" id="kt_toolbar_primary_button">
                        New Project </a>
                </div>
                <!--end::Actions--> --}}
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class=" container-xxl ">
                <!--begin::Card-->
                <div class="card ">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <h2 class="card-title fw-bold">
                            Calendar
                        </h2>

                        <div class="card-toolbar">
                            <button class="btn btn-flex btn-primary" data-kt-calendar="add">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Add Event
                            </button>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Calendar-->
                        <div id="kt_calendar_app" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                            <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                <div class="fc-toolbar-chunk">
                                    <div class="fc-button-group"><button type="button" title="Previous month"
                                            aria-pressed="false" class="fc-prev-button fc-button fc-button-primary"><span
                                                class="fc-icon fc-icon-chevron-left"></span></button><button type="button"
                                            title="Next month" aria-pressed="false"
                                            class="fc-next-button fc-button fc-button-primary"><span
                                                class="fc-icon fc-icon-chevron-right"></span></button></div><button
                                        type="button" title="This month" disabled="" aria-pressed="false"
                                        class="fc-today-button fc-button fc-button-primary">today</button>
                                </div>
                                <div class="fc-toolbar-chunk">
                                    <h2 class="fc-toolbar-title" id="fc-dom-1">June 2024</h2>
                                </div>
                                <div class="fc-toolbar-chunk">
                                    <div class="fc-button-group"><button type="button" title="month view"
                                            aria-pressed="true"
                                            class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active">month</button><button
                                            type="button" title="week view" aria-pressed="false"
                                            class="fc-timeGridWeek-button fc-button fc-button-primary">week</button><button
                                            type="button" title="day view" aria-pressed="false"
                                            class="fc-timeGridDay-button fc-button fc-button-primary">day</button></div>
                                </div>
                            </div>
                            <div aria-labelledby="fc-dom-1" class="fc-view-harness fc-view-harness-active"
                                style="height: 890.37px;">
                                <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                                    <table role="grid" class="fc-scrollgrid  fc-scrollgrid-liquid">
                                        <thead role="rowgroup">
                                            <tr role="presentation"
                                                class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                                <th role="presentation">
                                                    <div class="fc-scroller-harness">
                                                        <div class="fc-scroller" style="overflow: hidden;">
                                                            <table role="presentation" class="fc-col-header "
                                                                style="width: 1199px;">
                                                                <colgroup></colgroup>
                                                                <thead role="presentation">
                                                                    <tr role="row">
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-sun">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Sunday"
                                                                                    class="fc-col-header-cell-cushion ">Sun</a>
                                                                            </div>
                                                                        </th>
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-mon">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Monday"
                                                                                    class="fc-col-header-cell-cushion ">Mon</a>
                                                                            </div>
                                                                        </th>
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-tue">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Tuesday"
                                                                                    class="fc-col-header-cell-cushion ">Tue</a>
                                                                            </div>
                                                                        </th>
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-wed">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Wednesday"
                                                                                    class="fc-col-header-cell-cushion ">Wed</a>
                                                                            </div>
                                                                        </th>
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-thu">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Thursday"
                                                                                    class="fc-col-header-cell-cushion ">Thu</a>
                                                                            </div>
                                                                        </th>
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-fri">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Friday"
                                                                                    class="fc-col-header-cell-cushion ">Fri</a>
                                                                            </div>
                                                                        </th>
                                                                        <th role="columnheader"
                                                                            class="fc-col-header-cell fc-day fc-day-sat">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    aria-label="Saturday"
                                                                                    class="fc-col-header-cell-cushion ">Sat</a>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody role="rowgroup">
                                            <tr role="presentation"
                                                class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                                <td role="presentation">
                                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                                        <div class="fc-scroller fc-scroller-liquid-absolute"
                                                            style="overflow: hidden auto;">
                                                            <div class="fc-daygrid-body fc-daygrid-body-balanced "
                                                                style="width: 1199px;">
                                                                <table role="presentation"
                                                                    class="fc-scrollgrid-sync-table"
                                                                    style="width: 1199px; height: 842px;">
                                                                    <colgroup></colgroup>
                                                                    <tbody role="presentation">
                                                                        <tr role="row">
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other"
                                                                                data-date="2024-05-26"
                                                                                aria-labelledby="fc-dom-2">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-2"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to May 26, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">26</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other"
                                                                                data-date="2024-05-27"
                                                                                aria-labelledby="fc-dom-4">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-4"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to May 27, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">27</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other"
                                                                                data-date="2024-05-28"
                                                                                aria-labelledby="fc-dom-6">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-6"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to May 28, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">28</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other"
                                                                                data-date="2024-05-29"
                                                                                aria-labelledby="fc-dom-8">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-8"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to May 29, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">29</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-thu fc-day-past fc-day-other"
                                                                                data-date="2024-05-30"
                                                                                aria-labelledby="fc-dom-10">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-10"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to May 30, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">30</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-fri fc-day-past fc-day-other"
                                                                                data-date="2024-05-31"
                                                                                aria-labelledby="fc-dom-12">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-12"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to May 31, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">31</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2024-06-01"
                                                                                aria-labelledby="fc-dom-14">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-14"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 1, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">1</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-danger fc-event-solid-warning"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                All Day
                                                                                                                Event</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr role="row">
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2024-06-02"
                                                                                aria-labelledby="fc-dom-16">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-16"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 2, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">2</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-primary"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Company Trip
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2024-06-03"
                                                                                aria-labelledby="fc-dom-18">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-18"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 3, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">3</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                                            style="top: 0px; left: 0px; right: -171.281px;">
                                                                                            <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-light fc-event-solid-primary"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                ICT Expo
                                                                                                                2021 -
                                                                                                                Product
                                                                                                                Release
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 30px;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2024-06-04"
                                                                                aria-labelledby="fc-dom-20">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-20"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 4, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">4</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 30px;">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2024-06-05"
                                                                                aria-labelledby="fc-dom-22">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-22"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 5, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">5</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2024-06-06"
                                                                                aria-labelledby="fc-dom-24">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-24"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 6, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">6</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2024-06-07"
                                                                                aria-labelledby="fc-dom-26">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-26"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 7, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">7</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2024-06-08"
                                                                                aria-labelledby="fc-dom-28">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-28"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 8, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">8</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr role="row">
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2024-06-09"
                                                                                aria-labelledby="fc-dom-30">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-30"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 9, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">9</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-danger"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    4p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Repeating Event</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2024-06-10"
                                                                                aria-labelledby="fc-dom-32">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-32"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 10, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">10</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2024-06-11"
                                                                                aria-labelledby="fc-dom-34">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-34"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 11, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">11</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2024-06-12"
                                                                                aria-labelledby="fc-dom-36">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-36"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 12, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">12</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Dinner</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2024-06-13"
                                                                                aria-labelledby="fc-dom-38">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-38"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 13, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">13</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2024-06-14"
                                                                                aria-labelledby="fc-dom-40">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-40"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 14, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">14</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past fc-event-success"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    1:30p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Reporting</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2024-06-15"
                                                                                aria-labelledby="fc-dom-42">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-42"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 15, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">15</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr role="row">
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2024-06-16"
                                                                                aria-labelledby="fc-dom-44">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-44"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 16, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">16</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    4p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Repeating Event</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2024-06-17"
                                                                                aria-labelledby="fc-dom-46">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-46"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 17, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">17</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2024-06-18"
                                                                                aria-labelledby="fc-dom-48">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-48"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 18, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">18</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2024-06-19"
                                                                                aria-labelledby="fc-dom-50">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-50"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 19, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">19</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2024-06-20"
                                                                                aria-labelledby="fc-dom-52">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-52"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 20, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">20</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2024-06-21"
                                                                                aria-labelledby="fc-dom-54">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-54"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 21, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">21</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2024-06-22"
                                                                                aria-labelledby="fc-dom-56">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-56"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 22, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">22</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-primary"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Conference
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr role="row">
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sun fc-day-today "
                                                                                data-date="2024-06-23"
                                                                                aria-labelledby="fc-dom-58">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-58"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 23, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">23</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-primary"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Conference
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    10:30a</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Meeting</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                                            style="visibility: hidden; top: 0px; left: 0px; right: 0px;">
                                                                                            <a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-info"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    12p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Lunch</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                                            style="visibility: hidden; top: 0px; left: 0px; right: 0px;">
                                                                                            <a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-warning"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    2:30p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Meeting</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                                            style="visibility: hidden; top: 0px; left: 0px; right: 0px;">
                                                                                            <a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today fc-event-info"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    5:30p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Happy Hour</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-more-link fc-more-link"
                                                                                                title="Show 3 more events"
                                                                                                aria-expanded="false"
                                                                                                aria-controls=""
                                                                                                tabindex="0">+3 more</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                                data-date="2024-06-24"
                                                                                aria-labelledby="fc-dom-60">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-60"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 24, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">24</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future fc-event-primary"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    12p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Birthday Party</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future fc-event-solid-danger fc-event-light"
                                                                                                tabindex="0">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    6p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Dinner</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                                data-date="2024-06-25"
                                                                                aria-labelledby="fc-dom-62">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-62"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 25, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">25</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                                data-date="2024-06-26"
                                                                                aria-labelledby="fc-dom-64">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-64"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 26, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">26</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                                data-date="2024-06-27"
                                                                                aria-labelledby="fc-dom-66">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-66"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 27, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">27</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                                data-date="2024-06-28"
                                                                                aria-labelledby="fc-dom-68">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-68"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 28, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">28</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future fc-event-solid-info fc-event-light"
                                                                                                tabindex="0">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Site visit
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                                data-date="2024-06-29"
                                                                                aria-labelledby="fc-dom-70">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-70"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 29, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">29</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr role="row">
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                                data-date="2024-06-30"
                                                                                aria-labelledby="fc-dom-72">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-72"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to June 30, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">30</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-mon fc-day-future fc-day-other"
                                                                                data-date="2024-07-01"
                                                                                aria-labelledby="fc-dom-74">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-74"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to July 1, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">1</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-tue fc-day-future fc-day-other"
                                                                                data-date="2024-07-02"
                                                                                aria-labelledby="fc-dom-76">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-76"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to July 2, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">2</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other"
                                                                                data-date="2024-07-03"
                                                                                aria-labelledby="fc-dom-78">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-78"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to July 3, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">3</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other"
                                                                                data-date="2024-07-04"
                                                                                aria-labelledby="fc-dom-80">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-80"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to July 4, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">4</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other"
                                                                                data-date="2024-07-05"
                                                                                aria-labelledby="fc-dom-82">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-82"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to July 5, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">5</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td role="gridcell"
                                                                                class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other"
                                                                                data-date="2024-07-06"
                                                                                aria-labelledby="fc-dom-84">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            id="fc-dom-84"
                                                                                            class="fc-daygrid-day-number"
                                                                                            title="Go to July 6, 2024"
                                                                                            data-navlink=""
                                                                                            tabindex="0">6</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--end::Calendar-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->

                <!--begin::Modals-->
                <!--begin::Modal - New Product-->
                <div class="modal fade" id="kt_modal_add_event" tabindex-="1" aria-hidden="true"
                    data-bs-focus="false">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                                id="kt_modal_add_event_form">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold" data-kt-calendar="title">Add Event</h2>
                                    <!--end::Modal title-->

                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        id="kt_modal_add_event_close">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold required mb-2">Event Name</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="calendar_event_name">
                                        <!--end::Input-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2">Event Description</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="calendar_event_description">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2">Event Location</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="calendar_event_location">
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-9">
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="kt_calendar_datepicker_allday">
                                            <span class="form-check-label fw-semibold"
                                                for="kt_calendar_datepicker_allday">
                                                All Day
                                            </span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row row-cols-lg-2 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Event Start Date</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid flatpickr-input"
                                                    name="calendar_event_start_date" placeholder="Pick a start date"
                                                    id="kt_calendar_datepicker_start_date" type="text"
                                                    readonly="readonly">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Event Start Time</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid flatpickr-input"
                                                    name="calendar_event_start_time" placeholder="Pick a start time"
                                                    id="kt_calendar_datepicker_start_time" type="text"
                                                    readonly="readonly">
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="row row-cols-lg-2 g-10">
                                        <div class="col">
                                            <div class="fv-row mb-9 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2 required">Event End Date</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid flatpickr-input"
                                                    name="calendar_event_end_date" placeholder="Pick a end date"
                                                    id="kt_calendar_datepicker_end_date" type="text"
                                                    readonly="readonly">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col" data-kt-calendar="datepicker">
                                            <div class="fv-row mb-9">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Event End Time</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid flatpickr-input"
                                                    name="calendar_event_end_time" placeholder="Pick a end time"
                                                    id="kt_calendar_datepicker_end_time" type="text"
                                                    readonly="readonly">
                                                <!--end::Input-->
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Modal body-->

                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">
                                        Cancel
                                    </button>
                                    <!--end::Button-->

                                    <!--begin::Button-->
                                    <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - New Product--><!--begin::Modal - New Product-->
                <div class="modal fade" id="kt_modal_view_event" tabindex="-1" data-bs-focus="false"
                    aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header border-0 justify-content-end">
                                <!--begin::Edit-->
                                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2"
                                    data-bs-toggle="tooltip" data-bs-dismiss="click" id="kt_modal_view_event_edit"
                                    aria-label="Edit Event" data-bs-original-title="Edit Event"
                                    data-kt-initialized="1">
                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                                <!--end::Edit-->

                                <!--begin::Edit-->
                                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2"
                                    data-bs-toggle="tooltip" data-bs-dismiss="click" id="kt_modal_view_event_delete"
                                    aria-label="Delete Event" data-bs-original-title="Delete Event"
                                    data-kt-initialized="1">
                                    <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span><span class="path5"></span></i>
                                </div>
                                <!--end::Edit-->

                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary"
                                    data-bs-toggle="tooltip" data-bs-dismiss="click" aria-label="Hide Event"
                                    data-bs-original-title="Hide Event" data-kt-initialized="1">
                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->

                            <!--begin::Modal body-->
                            <div class="modal-body pt-0 pb-20 px-lg-17">
                                <!--begin::Row-->
                                <div class="d-flex">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-calendar-8 fs-1 text-muted me-5"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span><span
                                            class="path5"></span><span class="path6"></span></i> <!--end::Icon-->

                                    <div class="mb-9">
                                        <!--begin::Event name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></span> <span
                                                class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                        </div>
                                        <!--end::Event name-->

                                        <!--begin::Event description-->
                                        <div class="fs-6" data-kt-calendar="event_description"></div>
                                        <!--end::Event description-->
                                    </div>
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Bullet-->
                                    <span class="bullet bullet-dot h-10px w-10px bg-success ms-2 me-7"></span>
                                    <!--end::Bullet-->

                                    <!--begin::Event start date/time-->
                                    <div class="fs-6"><span class="fw-bold">Starts</span> <span
                                            data-kt-calendar="event_start_date"></span></div>
                                    <!--end::Event start date/time-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="d-flex align-items-center mb-9">
                                    <!--begin::Bullet-->
                                    <span class="bullet bullet-dot h-10px w-10px bg-danger ms-2 me-7"></span>
                                    <!--end::Bullet-->

                                    <!--begin::Event end date/time-->
                                    <div class="fs-6"><span class="fw-bold">Ends</span> <span
                                            data-kt-calendar="event_end_date"></span></div>
                                    <!--end::Event end date/time-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-geolocation fs-1 text-muted me-5"><span
                                            class="path1"></span><span class="path2"></span></i> <!--end::Icon-->

                                    <!--begin::Event location-->
                                    <div class="fs-6" data-kt-calendar="event_location"></div>
                                    <!--end::Event location-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Modal body-->
                        </div>
                    </div>
                </div>
                <!--end::Modal - New Product--><!--end::Modals-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
