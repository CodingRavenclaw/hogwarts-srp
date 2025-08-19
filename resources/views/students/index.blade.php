@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div class="container-fluid p-lg-5">
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
                    <th></th>
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
                        <td>
                            @if($student->bloodStatus->short_name === 'NB')
                                {{__('students.blood_status.nb')}}
                            @elseif($student->bloodStatus->short_name === 'PB')
                                {{__('students.blood_status.pb')}}
                            @elseif($student->bloodStatus->short_name === 'HB')
                                {{__('students.blood_status.hb')}}
                            @elseif($student->bloodStatus->short_name === 'MB')
                                {{__('students.blood_status.mb')}}
                            @endif
                        </td>
                        <td>{{ $student->enrollment_date->format('d.m.Y') }}</td>
                        <td>{{ $student->graduation_date ? $student->graduation_date->format('d.m.Y') : 'N/A' }}</td>
                        <td></td>
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
