@extends('layouts.app')

@section('title', 'Remove student')

@section('content')
    <div class="container">
        <form class="py-5" action="{{ route('students.delete', $student->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <h2 class="mb-4">{{ __('students.actions.remove') }}</h2>
            <strong class="text-danger">{{ __('students.actions.remove_warning') }}</strong>

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
                    </tr>
                    </thead>
                    <tbody>
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
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="my-3 my-lg-0 text-end">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">{{ __('nav.cancel') }}</a>
                <button type="submit" class="btn btn-danger">{{ __('students.actions.remove') }}</button>
            </div>
        </form>
    </div>
@endsection
