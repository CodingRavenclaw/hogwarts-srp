<div class="container-fluid p-lg-5">
    @if(session('success'))
        @include('alerts.success')
    @endif

    <div class="d-flex pb-3 align-items-center gap-2">
        <a class="btn btn-success" href="{{ route('students.add') }}">
            {{ __('students.actions.add') }}
        </a>

        <div class="position-relative mx-2">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                class="form-control w-auto pe-5"
                placeholder="{{ __('students.actions.search') }}"
                aria-label="{{ __('students.actions.search') }}"
            >
            <span
                class="position-absolute top-0 bottom-0 end-0 d-flex align-items-center pe-none"
                aria-hidden="true"
            >
            <span class="bg-primary text-white rounded-end px-3 h-100 d-inline-flex align-items-center">
                <i class="bi bi-search text-black"></i>
            </span>
        </span>
        </div>
    </div>
    <div class="table-responsive">
        @php
            $icon = fn($field) => $sortField === $field
                ? ($sortDirection === 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill')
                : 'bi-arrow-down-up text-muted';
        @endphp
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th role="button" class="user-select-none" wire:click="sortBy('id')">
                    ID <i class="bi {{ $icon('id') }}"></i>
                </th>                <th role="button" class="user-select-none" wire:click="sortBy('first_name')">
                    {{ __('students.first_name') }} <i class="bi {{ $icon('first_name') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('last_name')">
                    {{ __('students.last_name') }} <i class="bi {{ $icon('last_name') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('gender')">
                    {{__('students.gender.label')}} <i class="bi {{ $icon('gender') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('birthday')">
                    {{ __('students.birth_date') }} <i class="bi {{ $icon('birthday') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('house')">
                    {{ __('students.house') }} <i class="bi {{ $icon('house') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('blood_status')">
                    {{ __('students.blood_status.label') }} <i class="bi {{ $icon('blood_status') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('enrollment_date')">
                    {{ __('students.enrollment_date') }} <i class="bi {{ $icon('enrollment_date') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('graduation_date')">
                    {{ __('students.graduation_date') }} <i class="bi {{ $icon('graduation_date') }}"></i>
                </th>
                <th role="button" class="user-select-none" wire:click="sortBy('diploma')">
                    {{ __('students.diploma.label') }} <i class="bi {{ $icon('diploma') }}"></i>
                </th>
                <th>{{__('nav.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{__('students.gender.' . $student->gender)}}</td>
                    <td>{{ $student->birthday->format('d.m.Y') }}</td>
                    <td>{{ $student->house->name ?? 'N/A' }}</td>
                    <td>{{ __('students.blood_status.' . Str::lower($student->bloodStatus->short_name)) }}</td>
                    <td>{{ $student->enrollment_date->format('d.m.Y') }}</td>
                    <td>{{ $student->graduation_date ? $student->graduation_date->format('d.m.Y') : '' }}</td>
                    <td>{{ $student->diploma ? __('students.diploma.' . Str::lower($student->diploma->short_name)) : ''}}</td>
                    <td class="d-flex justify-content-between" style="min-width: 120px">
                        <a href="{{ route('students.exportPdf', $student->id) }}" target="_blank">
                            <i class="bi bi-file-pdf fs-4 text-danger"></i>
                        </a>
                        <a href="{{route('students.edit', [
                            'student' => $student->id,
                            'search' => $search,
                            'page' => $students->currentPage(),
                            'sort' => $sortField,
                            'dir' => $sortDirection
                            ])}}">
                            <i class="bt bi-pencil-square fs-4 text-success"></i>
                        </a>
                        <a href="{{route('students.remove', $student->id)}}">
                            <i class="bt bi-trash-fill fs-4 text-danger"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">{{__('students.no_students_found')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $students->links() }}
    </div>
</div>
