@if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-red-800">Please fix the following errors:</h4>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">Hero Content</h2>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label for="hero_label" class="block text-sm font-medium text-slate-700 mb-1.5">Hero Label <span class="text-red-500">*</span></label>
                    <input type="text" name="hero_label" id="hero_label" value="{{ old('hero_label', $aboutUs->hero_label ?? 'Who We Are') }}"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('hero_label') ? 'border-red-300' : '' }}">
                    @error('hero_label')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Page Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $aboutUs->title ?? '') }}" placeholder="About EuroVisa"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('title') ? 'border-red-300' : '' }}">
                    @error('title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-medium text-slate-700 mb-1.5">Subtitle</label>
                    <textarea name="subtitle" id="subtitle" rows="3"
                              class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('subtitle') ? 'border-red-300' : '' }}">{{ old('subtitle', $aboutUs->subtitle ?? '') }}</textarea>
                    @error('subtitle')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">About Sections</h2>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label for="story_title" class="block text-sm font-medium text-slate-700 mb-1.5">Story Title <span class="text-red-500">*</span></label>
                    <input type="text" name="story_title" id="story_title" value="{{ old('story_title', $aboutUs->story_title ?? 'Our Story') }}"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('story_title') ? 'border-red-300' : '' }}">
                    @error('story_title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="story_body" class="block text-sm font-medium text-slate-700 mb-1.5">Story Body <span class="text-red-500">*</span></label>
                    <textarea name="story_body" id="story_body" rows="6"
                              class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('story_body') ? 'border-red-300' : '' }}">{{ old('story_body', $aboutUs->story_body ?? '') }}</textarea>
                    @error('story_body')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="mission_title" class="block text-sm font-medium text-slate-700 mb-1.5">Mission Title <span class="text-red-500">*</span></label>
                    <input type="text" name="mission_title" id="mission_title" value="{{ old('mission_title', $aboutUs->mission_title ?? 'Our Mission') }}"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('mission_title') ? 'border-red-300' : '' }}">
                    @error('mission_title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="mission_body" class="block text-sm font-medium text-slate-700 mb-1.5">Mission Body <span class="text-red-500">*</span></label>
                    <textarea name="mission_body" id="mission_body" rows="6"
                              class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all {{ $errors->has('mission_body') ? 'border-red-300' : '' }}">{{ old('mission_body', $aboutUs->mission_body ?? '') }}</textarea>
                    @error('mission_body')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">Publishing</h2>
            </div>
            <div class="p-5">
                <label class="flex items-center justify-between cursor-pointer group">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Published</p>
                        <p class="text-xs text-slate-400 mt-0.5">Latest published page appears on the public About page.</p>
                    </div>
                    <div class="relative">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $aboutUs->is_published ?? false) ? 'checked' : '' }}
                               class="sr-only peer" id="is_published">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-emerald-500/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </div>
                </label>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
            <button type="submit"
                    class="w-full px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-colors shadow-sm">
                {{ $submitLabel }}
            </button>
            <a href="{{ route('dashboard.about-us.index') }}"
               class="block w-full text-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                Cancel
            </a>
        </div>
    </div>
</div>
