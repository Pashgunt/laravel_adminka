<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="/assets/js/main.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>

<body class="position-relative bg">
    <header class="header">
        <div class="container-fluid">
            <div class="row py-2 border-bottom">
                <div class="col-2"><a href="/" class="title">ToDo</a></div>
                @if (!\Illuminate\Support\Facades\Auth::check())
                    <div class="col-10 d-flex justify-content-end">
                        <a href="{{ route('register.page') }}" class="btn btn-primary btn-lg active">Регистрация</a>
                        <a href="{{ route('authorize.page') }}"
                            class="btn btn-secondary btn-lg active mx-1">Авторизация</a>
                    </div>
                @else
                    <div class="col-10 d-flex justify-content-end align-items-center">
                        <div class="d-flex">
                            <a
                                href="{{ route('profile', ['user_id' => \Illuminate\Support\Facades\Auth::user()['id']]) }}">
                                {!! \Illuminate\Support\Facades\Auth::user()['name'] !!}
                            </a>
                            @if (\Illuminate\Support\Facades\Auth::user()->role->role_name == \App\Models\Role::ROLE_ADMIN)
                                @include('chooseRole')
                            @endif
                        </div>
                        <a href="{{ route('logout') }}" class="btn btn-primary active ml-4"> <i
                                class="bi bi-box-arrow-right"></i> Выход</a>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <div class="fixed-top modal_window modal_window_hide w-100 h-100 align-items-center justify-content-center"
        style="background: rgba(0,0,0,.25)">
        <div class="create_task bg-white border rounded p-5 w-75 t-0 r-0">
            <h3 class="mb-4 pb-3 border-bottom">
                Создание задачи
            </h3>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="d-block">
                        Введите название задачи
                        <div class="alert alert-danger mb-3 task_name_error"></div>
                        <input type="text" id="task_name" class="form-control">
                    </label>
                </div>
                <div class="form-group mb-3">
                    <label class="d-block">
                        Введите краткое описание задачи
                        <div class="alert alert-danger mb-3 task_description_error"></div>
                        <textarea id="task_description" class="form-control"></textarea>
                    </label>
                </div>
                <div class="form-group mb-3">
                    <label class="d-block">
                        Выберите картинку
                        <div class="alert alert-danger mb-3 task_image_error"></div>
                        <input type="file" id="task_image" name="task_image" class="form-control">
                    </label>
                </div>
                <div class="form-group mb-3">
                    <label class="d-block">
                        Введите теги для задачи
                        <input type="text" id="task_tags_input" class="form-control">
                        <a href="#" class="btn btn-outline-success brn-sm mt-2 create_own_tag">Создать свой
                            тег</a>
                    </label>
                </div>
                <div class="rounded bg-light mb-3 p-1 tags_prepare_list d-flex flex-wrap"></div>

                <div class="tag_items mb-5">
                    <h4 class="mb-2">Теги:</h4>
                    <div class="d-flex flex-wrap"></div>
                </div>

                <button class="btn btn-primary add_new_task">Создать</button>
            </form>
        </div>
    </div>

    <div class="modal_confirm modal_window_hide fixed-top w-100 h-100 align-items-center justify-content-center"
        style="background: rgba(0,0,0,.25)">
        <div class="bg-white border rounded p-4 w-25 t-0 r-0">
            <h3 class="pb-3 mb-4 border-bottom">Вы уверены</h3>
            <div>
                <a href="#" class="btn btn-success confirm_success">Да, продолжить</a>
                <a href="#" class="btn btn-danger confirm_denied">Нет, назад</a>
            </div>
        </div>
    </div>

    <div class="modal_edit modal_window_hide fixed-top w-100 h-100 align-items-center justify-content-end"
        style="background: rgba(0,0,0,.25)">
        <div class="bg-white border rounded p-4 w-50 h-100 t-0 r-0">
            <h3 class="mb-4 pb-3 border-bottom">
                Редактирование задачи
            </h3>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="d-block">
                        Введите название задачи
                        <div class="alert alert-danger mb-3 task_name_error"></div>
                        <input type="text" id="task_name" class="form-control">
                    </label>
                </div>
                <div class="form-group mb-3">
                    <label class="d-block">
                        Введите краткое описание задачи
                        <div class="alert alert-danger mb-3 task_description_error"></div>
                        <textarea id="task_description" class="form-control"></textarea>
                    </label>
                </div>
                <div class="form-group mb-3">
                    <label class="d-block">
                        Выберите картинку
                        <div class="alert alert-danger mb-3 task_image_error"></div>
                        <input type="file" id="task_image" name="task_image" class="form-control">
                    </label>
                </div>
                <div class="form-group mb-3">
                    <label class="d-block">
                        Введите теги для задачи
                        <input type="text" id="task_tags_input" class="form-control">
                        <a href="#" class="btn btn-outline-success brn-sm mt-2 create_own_tag">Создать свой
                            тег</a>
                    </label>
                </div>
                <div class="rounded bg-light mb-3 p-1 tags_prepare_list d-flex flex-wrap"></div>

                <div class="tag_items mb-5">
                    <h4 class="mb-2">Теги:</h4>
                    <div class="d-flex flex-wrap"></div>
                </div>

                <button class="btn btn-primary edit_new_task">Изменить</button>
            </form>
        </div>
    </div>


    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>
