@if ($errors->any())
    <div class="rounded-xl bg-red-50 text-red-600 border border-red-200 px-4 py-3 text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Event Type</label>
        <select name="type_id" class="w-full rounded-lg border-gray-300">
            @foreach ($eventTypes as $eventType)
                <option value="{{ $eventType->type_id }}" @selected(old('type_id', $event->type_id ?? '') == $eventType->type_id)>{{ $eventType->type_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
        <select name="instructor_id" class="w-full rounded-lg border-gray-300">
            @foreach ($users as $user)
                <option value="{{ $user->user_id }}" @selected(old('instructor_id', $event->instructor_id ?? '') == $user->user_id)>{{ $user->first_name }} {{ $user->last_name }} (Role {{ $user->role_id }})</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input name="title" value="{{ old('title', $event->title ?? '') }}" class="w-full rounded-lg border-gray-300">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
        <input type="number" name="capacity" value="{{ old('capacity', $event->capacity ?? 1) }}" class="w-full rounded-lg border-gray-300">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300">{{ old('description', $event->description ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <input name="status" value="{{ old('status', $event->status ?? 'Scheduled') }}" class="w-full rounded-lg border-gray-300">
    </div>
</div>

<div class="flex gap-3 pt-2">
    <button class="bg-deepOcean text-white px-5 py-2.5 rounded-lg font-semibold">{{ $buttonText }}</button>
    <a href="{{ route('admin.events.index') }}" class="px-5 py-2.5 rounded-lg font-semibold text-deepOcean border border-gray-300 bg-white">Cancel</a>
</div>