<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Status Progres</title>
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
        }
        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
        }
        .progress-container {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .progress-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }
        .stage-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .stage {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 30%;
        }
        .stage-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }
        .status-label {
            font-size: 1.5rem;
            color: #495057;
            font-weight: 600;
        }
        .progress-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 5px;
        }
        .icon {
            position: absolute;
            right: 15px;
            top: 15px;
            color: #6c757d;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.8em;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Agenda</h2>

    <!-- Search Bar, Filter Dropdown, and Sort Dropdown -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control mb-2" placeholder="Cari Agenda..." onkeyup="filterAgenda()">
        <div class="d-flex">
            <select id="filterDropdown" class="form-select me-2" onchange="filterAgenda()">
                <option value="all">Semua</option>
                <option value="completed">Selesai</option>
                <option value="ongoing">Sedang Berlangsung</option>
                <option value="attention">Perlu Perhatian</option>
                <option value="delayed">Tertunda</option>
            </select>
            <select id="sortDropdown" class="form-select" onchange="sortAgendas()">
                <option value="none">Urutkan</option>
                <option value="deadline">Tenggat Waktu</option>
                <option value="status">Status</option>
            </select>
        </div>
    </div>

    <!-- Progress Containers -->
    <div id="agendaList">
        @foreach($menu_agenda as $item)
        <div class="progress-container" data-status="{{ $item->status }}" data-id="{{ $item->id }}" data-deadline="2024-07-10" 
             onclick="showModal('Agenda Cuti', '{{ $item->status }}', '10 Hari Lagi', '100%', 
             'Deskripsi agenda cuti...', 'Lampiran.pdf', '2024-07-01 - 2024-07-10')"
             data-title="{{ $item->kategori->nama_kategori }}">
             
            <div class="status-label">{{ $item->kategori->nama_kategori }}</div>
            <div class="stage-container">
                <div class="stage">
                    <div class="progress" data-bs-toggle="tooltip" data-bs-placement="top" title="Diterima">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="stage-label">
                        @php
                            $displayedStatuses = [];
                        @endphp
                        @foreach($status->where('menu_agenda_id', $item->id) as $stat)
                            @if(!in_array($stat->status, $displayedStatuses))
                                <span class="{{ $stat->status === 'disetujui' ? 'text-success' : ($stat->status === 'tidak_disetujui' ? 'text-danger' : '') }}">
                                    {{ ucfirst($stat->status) }}
                                </span>
                                @php
                                    $displayedStatuses[] = $stat->status;
                                @endphp
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="progress-status">
                <div class="progress-label">Tenggat waktu: 0 Hari Lagi</div>
                @if(Auth::user() && Auth::user()->isSekretaris())
                <button class="btn btn-primary" onclick="openEditModal(event, { id: '{{ $item->id }}', status: '{{ $item->status }}' })">Edit</button>
                @endif
            </div>
            <i class="fas fa-check-circle icon"></i>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal for showing agenda details -->
<div class="modal fade" id="agendaModal" tabindex="-1" aria-labelledby="agendaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agendaModalLabel">Agenda Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="agendaDescription"></p>
                <p id="agendaDeadline"></p>
                <a id="agendaAttachment" href="#" target="_blank">Lampiran</a>
                <p id="agendaDateRange"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing agenda -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Agenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAgendaForm" method="POST" action="/status">
                    @csrf
                    <div class="mb-3">                        
                        <label for="editAgendaId">ID Agenda</label>
                        <input type="text" class="form-control" id="editAgendaId" name="agenda_id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editStatus" class="form-label">Status</label>
                        <select id="editStatus" name="status" class="form-select" required>
                            <option value="diterima">Diterima</option>
                            <option value="dirapatkan">Dirapatkan</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="tidak_disetujui">Tidak Disetujui</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editKeterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="editKeterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openEditModal(event, agenda) {
        event.stopPropagation(); // Prevent triggering the agenda modal

        // Set agenda ID and status in the form
        document.getElementById('editAgendaId').value = agenda.id;
        document.getElementById('editStatus').value = agenda.status;

        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
        editModal.show();
    }

    // Update the agenda status and progress bar after form submission
    document.getElementById('editAgendaForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        const agendaId = document.getElementById('editAgendaId').value;
        const newStatus = document.getElementById('editStatus').value;
        const newKeterangan = document.getElementById('editKeterangan').value; // Get Keterangan
        const progressContainer = [...document.getElementsByClassName('progress-container')]
            .find(container => container.getAttribute('data-id') === agendaId);

        if (progressContainer) {
            // Remove old status
            const oldStatusElements = progressContainer.querySelector('.stage-label').children;
            for (let el of oldStatusElements) {
                el.remove();
            }

            // Add new status
            const newStatusElement = document.createElement('span');
            newStatusElement.className = newStatus === 'disetujui' ? 'text-success' : (newStatus === 'tidak_disetujui' ? 'text-danger' : '');
            newStatusElement.textContent = ucfirst(newStatus);
            progressContainer.querySelector('.stage-label').appendChild(newStatusElement);

            // Update progress bar
            const progressBar = progressContainer.querySelector('.progress-bar');
            progressBar.style.width = newStatus === 'disetujui' ? '100%' : '0%';
            progressBar.setAttribute('aria-valuenow', newStatus === 'disetujui' ? 100 : 0);

            // Update Keterangan display
            const keteranganElement = document.createElement('div');
            keteranganElement.className = 'badge bg-info'; // Optional styling for Keterangan
            keteranganElement.textContent = newKeterangan;
            progressContainer.querySelector('.progress-status').appendChild(keteranganElement);

            // Update the status attribute as well
            progressContainer.setAttribute('data-status', newStatus);
        }

        // Close the modal
        const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        editModal.hide();

        // Optionally, submit the form via AJAX here if needed
        this.submit();
    });

    function ucfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function filterAgenda() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const filterDropdown = document.getElementById('filterDropdown').value;
        const agendaList = document.getElementById('agendaList');
        const progressContainers = agendaList.getElementsByClassName('progress-container');

        for (let i = 0; i < progressContainers.length; i++) {
            const container = progressContainers[i];
            const title = container.getAttribute('data-title').toLowerCase();
            const status = container.getAttribute('data-status');

            const matchesSearch = title.includes(searchInput);
            const matchesFilter = (filterDropdown === 'all' || status === filterDropdown);

            if (matchesSearch && matchesFilter) {
                container.style.display = ''; // Show the container
            } else {
                container.style.display = 'none'; // Hide the container
            }
        }
    }
</script>
</body>
</html>
