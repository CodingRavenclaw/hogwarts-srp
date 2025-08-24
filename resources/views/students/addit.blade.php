@extends('layouts.app')

@section('title', $student ? __('students.actions.edit') : __('students.actions.add'))

@section('content')
    <div class="container">
        <form class="py-5" action="{{ $student ? route('students.update', $student->id) : route('students.store') }}" method="POST">
            @if($student)
                @method('PUT')
            @endif
            @csrf
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="page" value="{{ request('page') }}">
            <input type="hidden" name="sort" value="{{ request('sort') }}">
            <input type="hidden" name="dir" value="{{ request('dir') }}">

            <div class="row my-3">
                <div class="col-12 col-md-6">
                    <div class="form-group my-3 my-md-0">
                        <label for="first_name">{{ __('students.first_name') }}</label>
                        <input type="text"
                               class="form-control @error('first_name') is-invalid @enderror"
                               id="first_name"
                               name="first_name"
                               value="{{ old('first_name', $student?->first_name ?? '') }}"
                               required>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="last_name">{{ __('students.last_name') }}</label>
                        <input type="text"
                               class="form-control @error('last_name') is-invalid @enderror"
                               id="last_name"
                               name="last_name"
                               value="{{ old('last_name', $student?->last_name ?? '') }}"
                               required>
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label>{{ __('students.gender.label') }}</label>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                   type="radio" name="gender" id="female" value="f"
                                {{ old('gender', $student->gender ?? 'f') === 'f' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">{{__('students.gender.f')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('gender') is-invalid @enderror"
                                   type="radio" name="gender" id="male" value="m"
                                {{ old('gender', $student?->gender ?? 'm') === 'm' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">{{__('students.gender.m')}}</label>
                        </div>
                        @error('gender')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label for="birthday">{{ __('students.birth_date') }}</label>
                    <input type="date"
                           class="form-control @error('birthday') is-invalid @enderror"
                           id="birthday"
                           name="birthday"
                           value="{{ old('birthday', $student?->birthday->toDateString() ?? '') }}"
                           required>
                    @error('birthday')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label for="house_id">{{ __('students.house') }}</label>
                    <select class="form-select @error('house_id') is-invalid @enderror"
                            name="house_id" id="house_id" required>
                        @foreach($houses as $house)
                            <option
                                value="{{ $house->id }}" {{ old('house_id', $student?->house_id) == $house->id ? 'selected' : '' }}>
                                {{ $house->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('house_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label for="blood_status_id">{{ __('students.blood_status.label') }}</label>
                    <select class="form-select @error('blood_status_id') is-invalid @enderror"
                            name="blood_status_id" id="blood_status_id" required>
                        @foreach($bloodStatuses as $diploma)
                            <option
                                value="{{ $diploma->id }}" {{ old('blood_status_id', $student?->blood_status_id) == $diploma->id ? 'selected' : '' }}>
                                {{ __('students.blood_status.' . Str::lower($diploma->short_name)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('blood_status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label for="enrollment_date">{{ __('students.enrollment_date') }}</label>
                    <input type="date"
                           class="form-control @error('enrollment_date') is-invalid @enderror"
                           id="enrollment_date"
                           name="enrollment_date"
                           value="{{ old('enrollment_date', $student?->enrollment_date->toDateString()) }}"
                           required>
                    @error('enrollment_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label for="graduation_date">{{ __('students.graduation_date') }}</label>
                    <input type="date"
                           class="form-control @error('graduation_date') is-invalid @enderror"
                           id="graduation_date"
                           name="graduation_date"
                           value="{{ old('graduation_date', $student?->graduation_date?->toDateString()) }}">
                    @error('graduation_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label for="diploma_id">{{ __('students.diploma.label') }}</label>
                    <select class="form-select @error('diploma_id') is-invalid @enderror"
                            name="diploma_id" id="diploma_id">
                        <option value="">-</option>
                        @foreach($diplomas as $diploma)
                            <option
                                value="{{ $diploma->id }}" {{ old('diploma_id', $student?->diploma_id) == $diploma->id ? 'selected' : '' }}>
                                {{ __('students.diploma.' . Str::lower($diploma->short_name)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('diploma_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="my-3 btn btn-success">{{ $student ? __('students.actions.edit') : __('students.actions.add') }}</button>
        </form>
    </div>
@endsection
