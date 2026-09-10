<x-filament-panels::page>
    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
        
        <!-- Top Stats Overview -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
            <div style="padding: 1.25rem; border-radius: 1.25rem; background: rgba(244, 63, 94, 0.08); border: 1px solid rgba(244, 63, 94, 0.2); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #fb7185; letter-spacing: 0.05em;">Total Arsip Sampah</div>
                    <div style="font-size: 1.85rem; font-weight: 900; margin-top: 0.25rem;">{{ $this->trashCounts['all'] }}</div>
                </div>
                <div style="width: 2.8rem; height: 2.8rem; border-radius: 0.85rem; background: rgba(244, 63, 94, 0.15); display: flex; align-items: center; justify-content: center; color: #fb7185;">
                    <x-filament::icon icon="heroicon-o-trash" class="w-6 h-6" />
                </div>
            </div>

            <div style="padding: 1.25rem; border-radius: 1.25rem; background: rgba(245, 158, 11, 0.08); border: 1px solid rgba(245, 158, 11, 0.2); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #fbbf24; letter-spacing: 0.05em;">Kode Promo</div>
                    <div style="font-size: 1.85rem; font-weight: 900; margin-top: 0.25rem;">{{ $this->trashCounts['promo_codes'] }}</div>
                </div>
                <div style="width: 2.8rem; height: 2.8rem; border-radius: 0.85rem; background: rgba(245, 158, 11, 0.15); display: flex; align-items: center; justify-content: center; color: #fbbf24;">
                    <x-filament::icon icon="heroicon-o-ticket" class="w-6 h-6" />
                </div>
            </div>

            <div style="padding: 1.25rem; border-radius: 1.25rem; background: rgba(59, 130, 246, 0.08); border: 1px solid rgba(59, 130, 246, 0.2); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #60a5fa; letter-spacing: 0.05em;">Paket Tiket</div>
                    <div style="font-size: 1.85rem; font-weight: 900; margin-top: 0.25rem;">{{ $this->trashCounts['ticket_packages'] }}</div>
                </div>
                <div style="width: 2.8rem; height: 2.8rem; border-radius: 0.85rem; background: rgba(59, 130, 246, 0.15); display: flex; align-items: center; justify-content: center; color: #60a5fa;">
                    <x-filament::icon icon="heroicon-o-user-group" class="w-6 h-6" />
                </div>
            </div>

            <div style="padding: 1.25rem; border-radius: 1.25rem; background: rgba(16, 185, 129, 0.08); border: 1px solid rgba(16, 185, 129, 0.2); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #34d399; letter-spacing: 0.05em;">Wahana & Atraksi</div>
                    <div style="font-size: 1.85rem; font-weight: 900; margin-top: 0.25rem;">{{ $this->trashCounts['wahanas'] }}</div>
                </div>
                <div style="width: 2.8rem; height: 2.8rem; border-radius: 0.85rem; background: rgba(16, 185, 129, 0.15); display: flex; align-items: center; justify-content: center; color: #34d399;">
                    <x-filament::icon icon="heroicon-o-sparkles" class="w-6 h-6" />
                </div>
            </div>
        </div>

        <!-- Filter Tabs & Search Bar -->
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem;">
            <!-- Tabs -->
            <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; padding: 0.35rem; border-radius: 0.85rem; background: rgba(255, 255, 255, 0.04); border: 1px solid rgba(255, 255, 255, 0.08);">
                <button type="button" wire:click="setTab('all')" style="padding: 0.35rem 0.85rem; border-radius: 0.6rem; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; {{ $activeTab === 'all' ? 'background: #f43f5e; color: #fff;' : 'background: transparent; color: #94a3b8;' }}">
                    Semua ({{ $this->trashCounts['all'] }})
                </button>
                <button type="button" wire:click="setTab('promo_codes')" style="padding: 0.35rem 0.85rem; border-radius: 0.6rem; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; {{ $activeTab === 'promo_codes' ? 'background: #f43f5e; color: #fff;' : 'background: transparent; color: #94a3b8;' }}">
                    Kode Promo ({{ $this->trashCounts['promo_codes'] }})
                </button>
                <button type="button" wire:click="setTab('ticket_packages')" style="padding: 0.35rem 0.85rem; border-radius: 0.6rem; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; {{ $activeTab === 'ticket_packages' ? 'background: #f43f5e; color: #fff;' : 'background: transparent; color: #94a3b8;' }}">
                    Paket Tiket ({{ $this->trashCounts['ticket_packages'] }})
                </button>
                <button type="button" wire:click="setTab('wahanas')" style="padding: 0.35rem 0.85rem; border-radius: 0.6rem; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; {{ $activeTab === 'wahanas' ? 'background: #f43f5e; color: #fff;' : 'background: transparent; color: #94a3b8;' }}">
                    Wahana ({{ $this->trashCounts['wahanas'] }})
                </button>
                <button type="button" wire:click="setTab('transactions')" style="padding: 0.35rem 0.85rem; border-radius: 0.6rem; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; {{ $activeTab === 'transactions' ? 'background: #f43f5e; color: #fff;' : 'background: transparent; color: #94a3b8;' }}">
                    Transaksi ({{ $this->trashCounts['transactions'] }})
                </button>
                <button type="button" wire:click="setTab('users')" style="padding: 0.35rem 0.85rem; border-radius: 0.6rem; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s; {{ $activeTab === 'users' ? 'background: #f43f5e; color: #fff;' : 'background: transparent; color: #94a3b8;' }}">
                    Staff / User ({{ $this->trashCounts['users'] }})
                </button>
            </div>

            <!-- Search -->
            <div style="position: relative; min-width: 250px;">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search" 
                    placeholder="Cari data terhapus..." 
                    style="width: 100%; padding: 0.45rem 0.85rem 0.45rem 2.2rem; border-radius: 0.75rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.825rem;"
                />
                <div style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); pointer-events: none; color: #94a3b8;">
                    <x-filament::icon icon="heroicon-o-magnifying-glass" class="w-4 h-4" />
                </div>
            </div>
        </div>

        <!-- Trash Table Container -->
        <div class="fi-ta-ctn" style="overflow-x: auto; border-radius: 1.25rem;">
            <table style="width: 100%; text-align: left; border-collapse: collapse; font-size: 0.825rem;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.08); background: rgba(255, 255, 255, 0.02);">
                        <th style="padding: 0.9rem 1.2rem; font-weight: 800; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.05em; color: #94a3b8;">Modul / Tipe</th>
                        <th style="padding: 0.9rem 1.2rem; font-weight: 800; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.05em; color: #94a3b8;">Nama / Identitas Item</th>
                        <th style="padding: 0.9rem 1.2rem; font-weight: 800; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.05em; color: #94a3b8;">Dihapus Oleh</th>
                        <th style="padding: 0.9rem 1.2rem; font-weight: 800; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.05em; color: #94a3b8;">Waktu Dihapus</th>
                        <th style="padding: 0.9rem 1.2rem; font-weight: 800; text-transform: uppercase; font-size: 0.68rem; letter-spacing: 0.05em; color: #94a3b8; text-align: right;">Aksi Pemulihan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->trashItems as $item)
                        <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.04); transition: background 0.15s ease;">
                            <!-- Modul Badge -->
                            <td style="padding: 0.85rem 1.2rem; white-space: nowrap;">
                                <span class="fi-badge" style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.6rem; border-radius: 9999px; font-size: 0.72rem; font-weight: 800; background: rgba(244, 63, 94, 0.15); color: #fb7185; border: 1px solid rgba(244, 63, 94, 0.3);">
                                    <x-filament::icon :icon="$item['icon']" class="w-3.5 h-3.5" />
                                    <span>{{ $item['module'] }}</span>
                                </span>
                            </td>

                            <!-- Item Info -->
                            <td style="padding: 0.85rem 1.2rem;">
                                <div style="font-weight: 800; font-size: 0.88rem;">{{ $item['name'] }}</div>
                                <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 0.15rem;">{{ $item['info'] }}</div>
                            </td>

                            <!-- Deleted By -->
                            <td style="padding: 0.85rem 1.2rem; white-space: nowrap;">
                                <div style="display: flex; align-items: center; gap: 0.35rem;">
                                    <x-filament::icon icon="heroicon-m-user" class="w-3.5 h-3.5 text-slate-400" />
                                    <span style="font-weight: 700;">{{ $item['deleted_by_name'] }}</span>
                                </div>
                            </td>

                            <!-- Deleted At -->
                            <td style="padding: 0.85rem 1.2rem; white-space: nowrap;">
                                <div style="font-weight: 700;">{{ $item['deleted_at_formatted'] }}</div>
                                <div style="font-size: 0.7rem; color: #fb7185;">{{ $item['deleted_at_diff'] }}</div>
                            </td>

                            <!-- Actions -->
                            <td style="padding: 0.85rem 1.2rem; text-align: right; white-space: nowrap;">
                                <div style="display: inline-flex; align-items: center; gap: 0.4rem;">
                                    <!-- Snapshot Info Button -->
                                    <button 
                                        type="button" 
                                        wire:click="viewDetails('{{ addslashes($item['model_class']) }}', {{ $item['id'] }})"
                                        title="Lihat Snapshot Data"
                                        style="display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.32rem 0.6rem; border-radius: 0.55rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: #cbd5e1; font-size: 0.75rem; font-weight: 700; cursor: pointer;"
                                    >
                                        <x-filament::icon icon="heroicon-m-eye" class="w-3.5 h-3.5" />
                                        <span>Detail</span>
                                    </button>

                                    <!-- Put Back / Restore Button -->
                                    <button 
                                        type="button" 
                                        wire:click="restore('{{ addslashes($item['model_class']) }}', {{ $item['id'] }})"
                                        wire:confirm="Yakin ingin memulihkan data '{{ $item['name'] }}' kembali aktif?"
                                        style="display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.32rem 0.75rem; border-radius: 0.55rem; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; font-size: 0.75rem; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 2px 10px -2px rgba(16, 185, 129, 0.4);"
                                    >
                                        <x-filament::icon icon="heroicon-m-arrow-path" class="w-3.5 h-3.5" />
                                        <span>Pulihkan (Put Back)</span>
                                    </button>

                                    <!-- Force Delete Button (Super Admin Only) -->
                                    <button 
                                        type="button" 
                                        wire:click="forceDelete('{{ addslashes($item['model_class']) }}', {{ $item['id'] }})"
                                        wire:confirm="PERINGATAN: Tindakan ini akan MEMUSNAHKAN data '{{ $item['name'] }}' secara permanen dari database. Yakin lanjutkan?"
                                        title="Hapus Permanen"
                                        style="display: inline-flex; align-items: center; padding: 0.32rem 0.5rem; border-radius: 0.55rem; background: rgba(239, 68, 68, 0.12); border: 1px solid rgba(239, 68, 68, 0.25); color: #ef4444; font-size: 0.75rem; cursor: pointer;"
                                    >
                                        <x-filament::icon icon="heroicon-m-trash" class="w-3.5 h-3.5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 3rem; text-align: center; color: #94a3b8;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
                                    <div style="width: 3.5rem; height: 3.5rem; border-radius: 1rem; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: #10b981;">
                                        <x-filament::icon icon="heroicon-o-check-circle" class="w-8 h-8" />
                                    </div>
                                    <div style="font-weight: 800; font-size: 1rem;">Arsip Sampah Bersih</div>
                                    <div style="font-size: 0.8rem; max-width: 300px;">Tidak ada data yang sedang dihapus pada kategori ini.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Detail Snapshot Modal -->
        @if($selectedDetail)
            <div style="position: fixed; inset: 0; background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(12px); display: flex; align-items: center; justify-content: center; z-index: 9999; padding: 1.5rem;">
                <div style="width: 100%; max-width: 650px; max-height: 85vh; border-radius: 1.25rem; background: #0f172a; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); display: flex; flex-direction: column; overflow: hidden;">
                    
                    <!-- Header -->
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.08); display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <div style="font-size: 0.7rem; font-weight: 800; text-transform: uppercase; color: #fb7185; letter-spacing: 0.05em;">Snapshot Data Terhapus • {{ $selectedDetail['model'] }} #{{ $selectedDetail['id'] }}</div>
                            <div style="font-size: 1.1rem; font-weight: 900; margin-top: 0.15rem; color: #fff;">{{ $selectedDetail['name'] }}</div>
                        </div>
                        <button type="button" wire:click="closeDetails" style="background: none; border: none; color: #94a3b8; cursor: pointer; padding: 0.25rem;">
                            <x-filament::icon icon="heroicon-m-x-mark" class="w-6 h-6" />
                        </button>
                    </div>

                    <!-- Body Content -->
                    <div style="padding: 1.5rem; overflow-y: auto; flex: 1;">
                        <div style="margin-bottom: 1rem; font-size: 0.78rem; color: #94a3b8;">
                            Waktu Penghapusan: <strong style="color: #fff;">{{ $selectedDetail['deleted_at'] }}</strong>
                        </div>

                        <div style="background: rgba(0, 0, 0, 0.4); border-radius: 0.85rem; padding: 1rem; border: 1px solid rgba(255, 255, 255, 0.06); font-family: monospace; font-size: 0.78rem; max-height: 350px; overflow-y: auto;">
                            <pre style="margin: 0; white-space: pre-wrap; word-break: break-all; color: #38bdf8;">{{ json_encode($selectedDetail['attributes'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div style="padding: 1rem 1.5rem; border-top: 1px solid rgba(255, 255, 255, 0.08); display: flex; justify-content: flex-end; gap: 0.75rem;">
                        <button type="button" wire:click="closeDetails" style="padding: 0.45rem 1rem; border-radius: 0.65rem; background: rgba(255, 255, 255, 0.08); color: #fff; font-size: 0.8rem; font-weight: 700; border: none; cursor: pointer;">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-filament-panels::page>
