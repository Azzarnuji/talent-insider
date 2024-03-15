<div>
    <dialog id="my_modal_1" class="modal modal-middle" open="">
        <div class="absolute w-full h-full bg-black opacity-40"></div>
        <div class="modal-box">
            <h3 class="text-lg font-bold">Add Skill</h3>
            <div class="divider"></div>
            <form class="mb-2" wire:submit.prevent="submit">
                @error('selectedSkill')
                    <small class="text-left text-red-700">{{ $message }}</small>
                @enderror
                <label class="w-full form-control">
                    <div class="label">
                        <span class="font-bold label-text">Available Skills</span>
                    </div>
                    <select class="select select-bordered" wire:model="selectedSkill">
                        <option selected value="">Pick one</option>
                        @foreach ($listAvailableSkills as $skill)
                            <option value="{{ $skill->id }}">{{ $skill->nama_skill }}</option>
                        @endforeach
                    </select>

                </label>
                @error('descriptionSkill')
                    <small class="text-left text-red-700">{{ $message }}</small>
                @enderror
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Your bio</span>
                    </div>
                    <textarea class="h-24 textarea textarea-bordered" placeholder="Keterangan" wire:model='descriptionSkill'></textarea>
                </label>
                <div class="flex items-end justify-end">
                    <button class="mt-3 btn btn-primary btn-md">
                        <span><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M12 4V20" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg></span>
                        Tambah
                    </button>

                </div>
            </form>
            <div class="modal-action !justify-start">
                <form method="dialog">
                    <button class="btn" wire:click='$emit("addSkillState", false)'>Close</button>
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
        window.Livewire.on('skillAdded', (data) => {
            const dataOriginal = data.original
            if (dataOriginal.httpCode == 200) {
                window.Livewire.emit('updateData')
                window.Livewire.emit('addSkillState', false)
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
        window.Livewire.on('skillDeleted', (data) => {
            const dataOriginal = data.original
            if (dataOriginal.httpCode == 200) {
                window.Livewire.emit('updateData')
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
