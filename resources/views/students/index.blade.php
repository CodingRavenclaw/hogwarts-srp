@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="container-fluid p-lg-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const alert = document.getElementById("success-alert");
                    if (alert) {
                        setTimeout(() => {
                            alert.classList.remove("show");
                            alert.classList.add("fade");
                            setTimeout(() => alert.remove(), 500);
                        }, 5000);
                    }
                });
            </script>
        @endif


        <div class="d-flex pb-3">
            <a class="btn btn-success" href="{{route('students.add')}}">{{__('students.actions.add')}}</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('students.first_name')}}</th>
                    <th>{{__('students.last_name')}}</th>
                    <th>{{__('students.gender.label')}}</th>
                    <th>{{__('students.birth_date')}}</th>
                    <th>{{__('students.house')}}</th>
                    <th>{{__('students.blood_status.label')}}</th>
                    <th>{{__('students.enrollment_date')}}</th>
                    <th>{{__('students.graduation_date')}}</th>
                    <th>{{__('students.diploma.label')}}</th>
                    <th>{{__('nav.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>
                            @if($student->gender === 'f')
                                {{__('students.gender.f')}}
                            @elseif($student->gender === 'm')
                                {{__('students.gender.m')}}
                            @elseif($student->gender === 'd')
                                {{__('students.gender.d')}}
                            @else
                                n/a
                            @endif
                        </td>
                        <td>{{ $student->birthday->format('d.m.Y') }}</td>
                        <td>{{ $student->house->name ?? 'N/A' }}</td>
                        <td>{{ __('students.blood_status.' . Str::lower($student->bloodStatus->short_name)) }}</td>
                        <td>{{ $student->enrollment_date->format('d.m.Y') }}</td>
                        <td>{{ $student->graduation_date ? $student->graduation_date->format('d.m.Y') : '' }}</td>
                        <td>{{ $student->diploma ? __('students.diploma.' . Str::lower($student->diploma->short_name)) : ''}}</td>
                        <td class="d-flex justify-content-between">
                            <a href="{{ route('students.exportPdf', $student->id) }}" target="_blank">
                                <i class="bi bi-file-pdf fs-4 text-danger"></i>
                            </a>
                            <a href="{{route('students.edit', $student->id) }}">
                                <i class="bt bi-pencil-square fs-4 text-success"></i>
                            </a>
                            <a href="{{route('students.remove', $student->id)}}">
                                <i class="bt bi-trash-fill fs-4 text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Keine Schüler gefunden.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
@endsection
