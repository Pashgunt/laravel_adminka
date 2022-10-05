@extends('layout')
@section('title', 'Главная')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row mb-5 px-3">
        </div>
        <div class="row px-3 mb-4">
            <div class="col-12">
                <a href="#" class="btn btn-primary create_new_task">Создать новую задачу</a>
            </div>
        </div>
        <div class="row px-3 mb-5">
            <div class="col-12">
                <form class="d-flex align-items-center">
                    {{--                    @csrf--}}
                    {{--                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">--}}
                    <div class="form-group mr-5 w-25">
                        <label class="d-block">
                            Поиск по задачам
                            <input type="text" id="task_search" class="form-control">
                        </label>
                    </div>
                    <div class="form-group mr-5 w-25">
                        <label class="d-block">
                            Поиск по тегам
                            <input type="text" id="task_search" class="form-control">
                        </label>
                    </div>
                    <div>
                        <button class="btn btn-primary btn mr-2">Найти</button>
                        <button class="btn btn-outline-danger btn">Сбросить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-4">
                <div class="py-2 bg-info text-white border-bottom text-center w-100">Запланировано</div>
                <div class="p-1 mt-3">
                    @if(isset($tasks[\App\Models\Tasks::STATUS_PLANED]) && !empty($tasks[\App\Models\Tasks::STATUS_PLANED]))
                        @foreach($tasks[\App\Models\Tasks::STATUS_PLANED] as $item)
                            <div class="p-3 bg-light mb-4 rounded task_elem">
                                <div class="d-none task_id" data-id="{{$item['task_id']}}"></div>
                                <div class="d-flex flex-wrap mb-2">
                                    @if(!empty($item['tags']))
                                        @foreach($item['tags'] as $tag)
                                            <span
                                                class="bg-dark p-1 mr-1 mb-1 rounded text-white">{{$tag['tag_value']}}</span>
                                        @endforeach
                                    @else
                                        Теги отсутсвуют
                                    @endif
                                </div>
                                <h4 class="text-uppercase mb-2">{{$item['task_name']}}</h4>
                                <div class="mb-2">{{$item['description']}}</div>
                                <div class="mb-2">
                                    <span class="mr-2"
                                          style="font-size: 14px; color: rgba(167,167,167,0.75)">{{date("Y-m-d",strtotime($item['created_at']))}}</span>
                                    <span
                                        style="font-size: 14px; color: rgba(167,167,167,0.75)">{{$item['name']}}</span>
                                </div>
                                <div>
                                    <img src="{{asset('storage/'.$item['image_path'])}}" alt="">
                                </div>
                                <div class="d-flex flew-row flex-wrap">
                                    <a href="#" class="mb-2 btn btn-outline-warning mr-2 start_process_task">Начать
                                        выполнение</a>
                                    <a href="#" class="mb-2 btn btn-outline-success finish_process_task">Закончить
                                        выполнение</a>
                                    <a href="#" class="mb-2 btn btn-outline-info edit_task">Изменить</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mt-3">Задачи отсутсвуют</p>
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="py-2 bg-warning text-white border-bottom text-center w-100">Выполняется</div>
                <div class="p-1 mt-3">
                    @if(isset($tasks[\App\Models\Tasks::STATUS_PROCESS]) && !empty($tasks[\App\Models\Tasks::STATUS_PROCESS]))
                        @foreach($tasks[\App\Models\Tasks::STATUS_PROCESS] as $item)
                            <div class="p-3 bg-light mb-4 rounded task_elem">
                                <div class="d-none task_id" data-id="{{$item['task_id']}}"></div>
                                <div class="d-flex flex-wrap mb-2">
                                    @if(!empty($item['tags']))
                                        @foreach($item['tags'] as $tag)
                                            <span
                                                class="bg-dark p-1 mr-1 mb-1 rounded text-white">{{$tag['tag_value']}}</span>
                                        @endforeach
                                    @else
                                        Теги отсутсвуют
                                    @endif
                                </div>
                                <h4 class="text-uppercase mb-2">{{$item['task_name']}}</h4>
                                <div class="mb-2">{{$item['description']}}</div>
                                <div class="mb-2">
                                    <span class="mr-2"
                                          style="font-size: 14px; color: rgba(167,167,167,0.75)">{{date("Y-m-d",strtotime($item['created_at']))}}</span>
                                    <span
                                        style="font-size: 14px; color: rgba(167,167,167,0.75)">{{$item['name']}}</span>
                                </div>
                                <div>
                                    <img src="{{asset('storage/'.$item['image_path'])}}" alt="">
                                </div>
                                <div class="">
                                    <a href="#" class="mb-2 btn btn-outline-success finish_process_task">Закончить
                                        выполнение</a>
                                    <a href="#" class="btn mb-2 btn-outline-info edit_task">Изменить</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mt-3">Задачи отсутсвуют</p>
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="py-2 bg-success text-white border-bottom text-center w-100">Выполнено</div>
                <div class="p-1 mt-3">
                    @if(isset($tasks[\App\Models\Tasks::STATUS_SUCCESS]) && !empty($tasks[\App\Models\Tasks::STATUS_SUCCESS]))
                        @foreach($tasks[\App\Models\Tasks::STATUS_SUCCESS] as $item)
                            <div class="p-3 bg-light mb-4 rounded task_elem">
                                <div class="d-none task_id" data-id="{{$item['task_id']}}"></div>
                                <div class="d-flex flex-wrap mb-2">
                                    @if(!empty($item['tags']))
                                        @foreach($item['tags'] as $tag)
                                            <span
                                                class="bg-dark p-1 mr-1 mb-1 rounded text-white">{{$tag['tag_value']}}</span>
                                        @endforeach
                                    @else
                                        Теги отсутсвуют
                                    @endif
                                </div>
                                <h4 class="text-uppercase mb-2">{{$item['task_name']}}</h4>
                                <div class="mb-2">{{$item['description']}}</div>
                                <div class="mb-2">
                                    <span class="mr-2"
                                          style="font-size: 14px; color: rgba(167,167,167,0.75)">{{date("Y-m-d",strtotime($item['created_at']))}}</span>
                                    <span
                                        style="font-size: 14px; color: rgba(167,167,167,0.75)">{{$item['name']}}</span>
                                </div>
                                <div>
                                    <img src="{{asset('storage/'.$item['image_path'])}}" alt="">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center mt-3">Задачи отсутсвуют</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
