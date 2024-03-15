<div>
    <dialog id="my_modal_1" class="modal modal-middle" open="">
        <div class="absolute w-full h-full bg-black opacity-40"></div>
        <div class="modal-box">
            <h3 class="text-lg font-bold">Edit Skill</h3>
            <div class="divider"></div>
            <form class="mb-2" wire:submit.prevent="submit">
                @error('selectedSkill')
                    <small class="text-left text-red-700">{{ $message }}</small>
                @enderror
                <label class="w-full form-control">
                    <div class="label">
                        <span class="font-bold label-text">Available Skills</span>
                    </div>
                    <select class="select select-bordered" wire:model="selectedSkill" disabled>
                        @foreach ($listAvailableSkills as $skill)
                            <option value="{{ $skill->id }}"
                                {{ $skill->id == $selectedSkill ? 'selected="selected"' : '' }}>
                                {{ $skill->nama_skill }}</option>
                        @endforeach
                    </select>

                </label>
                @error('descriptionSkill')
                    <small class="text-left text-red-700">{{ $message }}</small>
                @enderror
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Keterangan</span>
                    </div>
                    <textarea class="h-24 textarea textarea-bordered" placeholder="Keterangan" wire:model='descriptionSkill' wire:ignore></textarea>
                </label>
                <div class="flex items-end justify-end">
                    <button class="mt-3 btn btn-primary btn-md">
                        Simpan
                    </button>

                </div>
            </form>
            <div class="modal-action !justify-start">
                <form method="dialog">
                    <button class="btn" wire:click='$emit("editSkillState", false, null)'>Close</button>
                </form>
            </div>

        </div>
    </dialog>

    <script>
        // Get the current URL without the query string
        var currentUrlWithoutQueryString = window.location.protocol + "//" + window.location.host + window.location
            .pathname;

        // Update the URL without the query string
        history.pushState(null, null, currentUrlWithoutQueryString);
        window.Livewire.on('skillUpdated', (data) => {
            const dataOriginal = data.original
            if (dataOriginal.httpCode == 200) {
                window.Livewire.emit('updateData')
                window.Livewire.emit('editSkillState', false, null)
                Swal.fire({
                    icon: 'success',
                    text: dataOriginal.message
                })
            } else {
                Swal.fire({
                    icon: "info",
                    text: dataOriginal.message
                })
            }
        })
    </script>
</div>
