@if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4">
        <h4 class="text-sm font-semibold text-red-800">Please fix the following errors:</h4>
        <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100">
            <h2 class="text-base font-semibold text-slate-800">Service Content</h2>
        </div>
        <div class="p-5 space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $service->title ?? '') }}"
                       class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                @error('title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="icon" class="block text-sm font-medium text-slate-700 mb-1.5">Icon</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $service->icon ?? '') }}" placeholder="✈ or 💼"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                    @error('icon')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-slate-700 mb-1.5">Sort Order</label>
                    <input type="number" min="0" name="sort_order" id="sort_order" value="{{ old('sort_order', $service->sort_order ?? 0) }}"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                    @error('sort_order')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="6"
                          class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">{{ old('description', $service->description ?? '') }}</textarea>
                @error('description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100"><h2 class="text-base font-semibold text-slate-800">Publishing</h2></div>
            <div class="p-5">
                <label class="flex items-center justify-between cursor-pointer">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Published</p>
                        <p class="text-xs text-slate-400 mt-0.5">Published services show publicly.</p>
                    </div>
                    <div class="relative">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $service->is_published ?? false) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </div>
                </label>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
            <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">{{ $submitLabel }}</button>
            <a href="{{ route('dashboard.services.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Cancel</a>
        </div>
    </div>
</div>
