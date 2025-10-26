<section aria-labelledby="places-title">
    <style>
        /* Responsive design for mobile, tablet, and PC */
        .places-container {
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .places-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .places-header h2 {
            font-size: 1.8rem;
            color: #1d4ed8; /* Primary blue */
        }

        .places-header button {
            background-color: #3b82f6; /* Button blue */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .places-header button:hover {
            background-color: #2563eb; /* Darker blue */
        }

        .places-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .places-table th, .places-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .places-table th {
            background-color: #1d4ed8; /* Header blue */
            color: white;
        }

        .places-table td img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }

        .places-table td .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-edit {
            background-color: #4caf50; /* Green */
            color: white;
        }

        .btn-edit:hover {
            background-color: #388e3c; /* Darker green */
        }

        .btn-delete {
            background-color: #f44336; /* Red */
            color: white;
        }

        .btn-delete:hover {
            background-color: #d32f2f; /* Darker red */
        }

        @media (max-width: 600px) {
            .places-header h2 {
                font-size: 1.5rem;
            }

            .places-header button {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            .places-table {
                width: 100%;
                border-collapse: collapse;
            }

            .places-table th, .places-table td {
                display: block;
                width: 100%;
                text-align: left;
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            .places-table th {
                background-color: #1d4ed8;
                color: white;
                font-size: 1rem;
            }

            .places-table td {
                font-size: 0.9rem;
            }

            .places-table td img {
                width: 100%;
                height: auto;
                margin-bottom: 10px;
            }

            .places-table td .btn {
                display: block;
                width: 100%;
                margin-bottom: 10px;
                text-align: center;
            }
        }

        @media (min-width: 601px) and (max-width: 900px) {
            .places-header h2 {
                font-size: 1.6rem;
            }

            .places-header button {
                font-size: 1rem;
                padding: 10px 20px;
            }

            .places-table th, .places-table td {
                font-size: 0.9rem;
            }
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff; /* White background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            z-index: 1000;
        }

        .modal-header {
            background-color: #1d4ed8; /* Blue header */
            color: #ffffff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .modal-body {
            padding: 20px;
            background-color: #f8fafc; /* Light gray body */
        }

        .modal-footer {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: #3b82f6; /* Blue footer */
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .modal-footer button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #4caf50; /* Green button */
            color: #ffffff;
        }

        .btn-secondary {
            background-color: #f44336; /* Red button */
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #388e3c; /* Darker green */
        }

        .btn-secondary:hover {
            background-color: #d32f2f; /* Darker red */
        }

        /* Improved modal form fields design */
        .modal-body form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .modal-body label {
            font-weight: 600;
            color: #1d4ed8;
            margin-bottom: 6px;
        }
        .modal-body input[type="text"],
        .modal-body input[type="file"] {
            padding: 10px 12px;
            border: 1.5px solid #3b82f6;
            border-radius: 6px;
            font-size: 1rem;
            background: #f1f5f9;
            color: #0f172a;
            transition: border-color 0.2s;
        }
        .modal-body input[type="text"]:focus,
        .modal-body input[type="file"]:focus {
            border-color: #1d4ed8;
            outline: none;
            background: #e0e7ef;
        }
        .modal-body input[type="file"] {
            padding: 8px 0;
            background: #f8fafc;
        }
    </style>

    <div class="places-container">
        <div class="places-header">
            <h2 id="places-title">Places</h2>
            <button id="addPlaceBtn">Ajouter une place</button>
        </div>

        <table class="places-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="placesBody">
                <tr>
                    <td colspan="3" class="muted">Chargement...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-header">Ajouter une catégorie</div>
        <div class="modal-body">
            <form id="addForm">
                <label for="addName">Nom:</label>
                <input type="text" id="addName" name="name" required>

                <label for="addImage">Image:</label>
                <input type="file" id="addImage" name="image" accept="image/*">
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" form="addForm">Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('addModal')">Annuler</button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-header">Modifier une catégorie</div>
        <div class="modal-body">
            <form id="editForm">
                <label for="editName">Nom:</label>
                <input type="text" id="editName" name="name" required>

                <label for="editImage">Image:</label>
                <input type="file" id="editImage" name="image" accept="image/*">
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" form="editForm">Modifier</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Annuler</button>
        </div>
    </div>

    <script>
        (function(){
            const univ = new URLSearchParams(window.location.search).get('univ') || '1';
            const base = `/kodpwomo/backend/places/adm`;

            function escape(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

            async function fetchPlaces(){
                const url = `${base}/${univ}`;
                try{
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                    const txt = await res.text(); if(!txt) throw new Error('empty');
                    const data = JSON.parse(txt);
                    render(data.places || []);
                }catch(e){ document.getElementById('placesBody').innerHTML = `<tr><td colspan="3" class="muted">Erreur: ${e.message}</td></tr>` }
            }

            function render(list){
                const body = document.getElementById('placesBody'); body.innerHTML = '';
                if(!list.length) { body.innerHTML = `<tr><td colspan="3" class="muted">Aucune place</td></tr>`; return }
                for(const p of list){
                    const tr = document.createElement('tr');
                    const imagePath = p.image ? `/kodpwomo/image/room/${p.image}`.replace('//','/') : null;
                    const picture = imagePath ? `<img src="${escape(imagePath)}" alt="${escape(p.salle_name||'Salle')}">` : `<div style="width:50px;height:50px;background:#e2e8f0;color:#1d4ed8;font-weight:700;display:flex;align-items:center;justify-content:center;border-radius:5px;">${(p.salle_name||'?').slice(0,2).toUpperCase()}</div>`;
                    tr.innerHTML = `
                        <td>${picture}</td>
                        <td>${escape(p.salle_name)}</td>
                        <td>
                            <button class="btn btn-edit" data-edit="${escape(p.id)}">Modifier</button>
                            <button class="btn btn-delete" data-delete="${escape(p.id)}">Supprimer</button>
                        </td>
                    `;
                    // Store the place data on the row for quick access
                    tr.dataset.place = JSON.stringify(p);
                    body.appendChild(tr);
                }

                // attach handlers
                body.querySelectorAll('button[data-edit]').forEach(b=> b.addEventListener('click', function(){
                    const tr = b.closest('tr');
                    const place = JSON.parse(tr.dataset.place);
                    document.getElementById('editName').value = place.salle_name || '';
                    document.getElementById('editForm').dataset.placeId = place.id;
                    openModal('editModal');
                }));
                body.querySelectorAll('button[data-delete]').forEach(b=> b.addEventListener('click', ()=> removePlace(b.getAttribute('data-delete'))));
            }

            async function loadForEdit(id){
                try{
                    const res = await fetch(`${base}/${univ}/${encodeURIComponent(id)}`, { headers:{'Accept':'application/json'} });
                    const txt = await res.text(); if(!txt) throw new Error('empty');
                    const data = JSON.parse(txt);
                    const p = data.place || data;
                    document.getElementById('editName').value = p.salle_name || '';
                    // Image preview logic can be added here
                    openModal('editModal');
                }catch(e){ alert('Erreur chargement: '+(e.message||e)); }
            }

            async function removePlace(id){
                if(!confirm('Confirmer suppression ?')) return;
                try{
                    const res = await fetch(`${base}/${univ}/${encodeURIComponent(id)}`, { method: 'DELETE', headers:{'Accept':'application/json'} });
                    await res.text();
                    fetchPlaces();
                }catch(e){ alert('Erreur suppression: '+(e.message||e)); }
            }

            document.getElementById('addPlaceBtn').addEventListener('click', ()=>{
                document.getElementById('addForm').reset();
                openModal('addModal');
            });

            document.getElementById('addForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(e.target);
                try {
                    const res = await fetch(`${base}/${univ}`, {
                        method: 'POST',
                        body: formData,
                        headers: { 'Accept': 'application/json' }
                    });
                    await res.text();
                    closeModal('addModal');
                    fetchPlaces();
                } catch (e) {
                    alert('Erreur ajout: ' + (e.message || e));
                }
            });

            // Handle edit form submission for name (PUT JSON)
            document.getElementById('editForm').addEventListener('submit', async function(e) {
                e.preventDefault();
                const name = document.getElementById('editName').value;
                const placeId = this.dataset.placeId;
                try {
                    const res = await fetch(`/kodpwomo/backend/places/adm/${placeId}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ name })
                    });
                    const data = await res.json();
                    if (res.ok && data.success) {
                        alert(data.success);
                        closeModal('editModal');
                        location.reload();
                    } else if (data.error) {
                        alert(data.error);
                    } else {
                        alert('Erreur lors de la modification');
                    }
                } catch (err) {
                    alert('Erreur réseau');
                }
            });

            // Handle image update (POST FormData)
            document.getElementById('editImage').addEventListener('change', async function(e) {
                const placeId = document.getElementById('editForm').dataset.placeId;
                const image = this.files[0];
                if (!image) return;
                const formData = new FormData();
                formData.append('image', image);
                try {
                    const res = await fetch(`/kodpwomo/backend/places/image-update/adm/${placeId}`, {
                        method: 'POST',
                        body: formData
                    });
                    if (!res.ok) {
                        alert('Erreur lors de la modification de l\'image');
                    }
                } catch (err) {
                    alert('Erreur réseau lors de l\'upload image');
                }
            });

            // initial load
            fetchPlaces();
        })();

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    </script>
</section>