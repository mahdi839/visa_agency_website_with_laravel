@if($errors->any())<div class="bg-red-50 border border-red-200 rounded-xl px-5 py-4 text-sm text-red-700">{{ $errors->first() }}</div>@endif

<div class="bg-white rounded-xl border border-slate-200 p-5 space-y-4 max-w-3xl">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Name</label><input name="name" value="{{ old('name', $testimonial->name ?? '') }}" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Location</label><input name="location" value="{{ old('location', $testimonial->location ?? '') }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Visa Type</label><input name="visa_type" value="{{ old('visa_type', $testimonial->visa_type ?? '') }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Rating</label><select name="rating" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">@for($i = 5; $i >= 1; $i--)<option value="{{ $i }}" @selected(old('rating', $testimonial->rating ?? 5) == $i)>{{ $i }}</option>@endfor</select></div>
    </div>
    <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Message</label><textarea name="message" rows="6" required class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg">{{ old('message', $testimonial->message ?? '') }}</textarea></div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div><label class="block text-sm font-medium text-slate-700 mb-1.5">Sort Order</label><input type="number" min="0" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-lg"></div>
        <label class="flex items-center gap-2 text-sm font-medium text-slate-700 pt-8"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $testimonial->is_published ?? true))> Published</label>
    </div>
    <div class="flex gap-3"><button class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg">{{ $submitLabel }}</button><a href="{{ route('dashboard.testimonials.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-700 bg-slate-100 rounded-lg">Cancel</a></div>
</div>
