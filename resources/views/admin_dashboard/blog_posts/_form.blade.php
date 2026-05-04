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
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">Post Content</h2>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $blogPost->title ?? '') }}"
                           class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                    @error('title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Blog Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="12"
                              class="ckeditor w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">{{ old('description', $blogPost->description ?? '') }}</textarea>
                    @error('description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">Feature Image</h2>
            </div>
            <div class="p-5 space-y-3">
                @if(!empty($blogPost?->feature_image))
                    <img src="{{ asset('storage/'.$blogPost->feature_image) }}" alt="{{ $blogPost->title }}" class="w-full h-40 object-cover rounded-lg border border-slate-200">
                @endif
                <input type="file" name="feature_image" id="feature_image" accept="image/*"
                       class="block w-full text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:text-sm file:font-medium file:text-slate-700 hover:file:bg-slate-200">
                @error('feature_image')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100">
                <h2 class="text-base font-semibold text-slate-800">Publishing</h2>
            </div>
            <div class="p-5">
                <label class="flex items-center justify-between cursor-pointer">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Published</p>
                        <p class="text-xs text-slate-400 mt-0.5">Published posts show on Blog and home Latest Updates.</p>
                    </div>
                    <div class="relative">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blogPost->is_published ?? false) ? 'checked' : '' }} class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </div>
                </label>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-5 space-y-3">
            <button type="submit" class="w-full px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors shadow-sm">{{ $submitLabel }}</button>
            <a href="{{ route('dashboard.blog-posts.index') }}" class="block w-full text-center px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Cancel</a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editor = document.querySelector('.ckeditor');

        if (!editor || typeof ClassicEditor === 'undefined') return;

        ClassicEditor.create(editor, {
            toolbar: [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                '|',
                'bulletedList',
                'numberedList',
                'blockQuote',
                '|',
                'undo',
                'redo'
            ]
        }).catch(function (error) {
            console.error(error);
        });
    });
</script>
@endpush
