<?php
// Products admin page — Material Design update while keeping original API behavior
?>
<section aria-labelledby="products-title" class="md-products">
    <style>
        /* KodPwomo Design System - inherit from parent admin shell */
        :root{
            /* Use global KodPwomo palette from admin shell */
            --local-primary: var(--brand-primary, #FF6B6B);
            --local-secondary: var(--brand-secondary, #4ECDC4);
            --local-accent: var(--brand-accent, #45B7D1);
            --local-success: var(--brand-success, #96CEB4);
            --local-warning: var(--brand-warning, #FFEAA7);
            --local-danger: var(--brand-danger, #FF7675);
            --local-info: var(--brand-info, #74B9FF);
            --local-surface: var(--surface-elevated, #ffffff);
            --local-surface-dim: var(--surface-dim, #f8fafc);
            --local-text: var(--on-surface, #0f172a);
            --local-text-muted: var(--on-surface-muted, #64748b);
            --local-shadow: rgba(255, 107, 107, 0.15);
        }

        .md-products{background:var(--local-surface-dim);padding:16px;border-radius:16px;min-height:100vh}

        .md-hero{
            display:flex;align-items:center;justify-content:space-between;gap:20px;
            background:linear-gradient(135deg, var(--local-surface) 0%, var(--local-surface-dim) 100%);
            padding:20px 24px;border-radius:16px;
            box-shadow:0 4px 12px var(--local-shadow);
            border:2px solid var(--local-secondary);
            margin-bottom:20px
        }
        .md-hero .left{display:flex;flex-direction:column;gap:4px}
        .md-hero h2{
            margin:0;font-weight:700;font-size:1.5rem;
            background:linear-gradient(45deg, var(--local-primary), var(--local-secondary));
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;
            background-clip:text;color:var(--local-primary)
        }
        .md-hero .subtitle{
            color:var(--local-text-muted);font-size:1rem;font-weight:500;
            background:var(--accent-100);padding:4px 12px;border-radius:20px;
            display:inline-block;border:1px solid var(--local-accent)
        }

        .md-controls{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
        .md-input{
            padding:12px 16px;border-radius:12px;
            border:2px solid var(--local-secondary);min-width:240px;
            background:var(--local-surface);color:var(--local-text);
            box-shadow:inset 0 2px 4px var(--local-shadow);
            transition:all 0.3s ease
        }
        .md-input:focus{border-color:var(--local-accent);outline:none;box-shadow:0 0 0 3px rgba(69, 183, 209, 0.2)}
        
        .md-btn{
            background:linear-gradient(135deg, var(--local-primary), var(--local-secondary));
            color:#fff;padding:12px 18px;border-radius:12px;border:0;cursor:pointer;
            font-weight:600;text-transform:uppercase;letter-spacing:0.5px;
            box-shadow:0 4px 8px var(--local-shadow);
            transition:all 0.3s ease;position:relative;overflow:hidden
        }
        .md-btn:hover{transform:translateY(-2px);box-shadow:0 6px 16px var(--local-shadow)}
        .md-btn:before{content:'';position:absolute;inset:0;background:linear-gradient(45deg,transparent,rgba(255,255,255,0.2),transparent);transform:translateX(-100%);transition:transform 0.6s ease}
        .md-btn:hover:before{transform:translateX(100%)}
        
        .md-btn.secondary{
            background:var(--local-surface);
            border:2px solid var(--local-primary);color:var(--local-primary);
            box-shadow:0 2px 6px var(--local-shadow)
        }

        .md-grid{margin-top:20px;display:grid;grid-template-columns:1fr;gap:16px}

        /* Enhanced table styling */
        .md-table{
            background:var(--local-surface);border-radius:16px;padding:20px;
            border:2px solid var(--local-secondary);overflow:auto;
            box-shadow:0 8px 24px var(--local-shadow)
        }
        table.md{width:100%;border-collapse:collapse}
        table.md th, table.md td{padding:16px 12px;text-align:left;border-bottom:2px solid var(--secondary-100)}
        table.md thead{background:linear-gradient(135deg, var(--local-primary), var(--local-secondary))}
        table.md thead th{
            font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:0.5px;
            border-bottom:none;font-size:0.9rem
        }
        table.md tbody tr:nth-child(odd){background:linear-gradient(90deg, var(--primary-50), var(--secondary-50))}
        table.md tbody tr:hover{
            background:linear-gradient(90deg, var(--accent-100), var(--success-100));
            transform:scale(1.01);transition:all 0.2s ease
        }
        table.md tbody td{color:var(--local-text);font-weight:500}

        .chip{
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 14px;border-radius:20px;font-weight:700;
            text-transform:uppercase;letter-spacing:0.3px;font-size:0.85rem;
            box-shadow:0 2px 6px rgba(0,0,0,0.1)
        }
        .chip.success{
            background:linear-gradient(135deg, var(--success-100), var(--success-50));
            color:var(--local-success);border:2px solid var(--local-success)
        }
        .chip.success:before{content:'✅';margin-right:4px}
        .chip.warn{
            background:linear-gradient(135deg, var(--warning-100), var(--warning-50));
            color:var(--local-warning);border:2px solid var(--local-warning)
        }
        .chip.warn:before{content:'⚠️';margin-right:4px}

        .md-card{
            background:var(--local-surface);border-radius:16px;padding:16px;
            border:2px solid var(--local-secondary);display:flex;gap:12px;align-items:center;
            box-shadow:0 6px 18px var(--local-shadow);
            transition:all 0.3s ease;position:relative;overflow:hidden
        }
        .md-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px var(--local-shadow)}
        .md-card:before{
            content:'';position:absolute;top:0;left:0;right:0;height:4px;
            background:linear-gradient(90deg, var(--local-primary), var(--local-accent))
        }
        .md-card .meta{flex:1}
        .md-card .meta .title{font-weight:700;color:var(--local-text);font-size:1.1rem}
        .md-card .meta .sub{
            color:var(--local-text-muted);font-size:1rem;
            background:var(--accent-100);padding:4px 8px;border-radius:12px;
            display:inline-block;margin-top:4px;border:1px solid var(--local-accent)
        }

        .md-card .avatar{
            width:64px;height:64px;border-radius:16px;
            background:linear-gradient(135deg, var(--local-primary), var(--local-accent));
            display:flex;align-items:center;justify-content:center;
            font-weight:900;color:#fff;font-size:1.2rem;
            box-shadow:0 4px 12px var(--local-shadow)
        }

        .pagination{display:flex;gap:10px;align-items:center;margin-top:16px;justify-content:center}
        .pagination button{
            padding:10px 14px;border-radius:12px;border:0;
            background:linear-gradient(135deg, var(--local-surface), var(--local-surface-dim));
            color:var(--local-primary);cursor:pointer;font-weight:600;
            border:2px solid var(--local-secondary);
            transition:all 0.3s ease
        }
        .pagination button:hover{
            background:linear-gradient(135deg, var(--local-primary), var(--local-secondary));
            color:#fff;transform:translateY(-2px)
        }
        .pagination button:disabled{opacity:0.5;cursor:not-allowed;transform:none}

        .md-toggle{
            background:linear-gradient(135deg, var(--local-warning), var(--local-info));
            color:#fff;padding:8px 12px;border-radius:10px;border:0;cursor:pointer;
            font-weight:600;text-transform:uppercase;font-size:0.8rem;
            box-shadow:0 3px 8px var(--local-shadow);
            transition:all 0.3s ease
        }
        .md-toggle:hover{transform:scale(1.05);box-shadow:0 4px 12px var(--local-shadow)}

        /* Enhanced snackbar */
        #mdSnackbar{
            background:linear-gradient(135deg, var(--local-primary), var(--local-secondary))!important;
            color:#fff!important;padding:12px 20px!important;border-radius:12px!important;
            box-shadow:0 8px 24px var(--local-shadow)!important;
            border:2px solid var(--local-accent)!important;
            font-weight:600!important
        }

        /* Responsive enhancements */
        @media(min-width:720px){ .md-grid{grid-template-columns:1fr} .cards-mobile{display:none} }
        @media(max-width:719px){ 
            .md-table{display:none} 
            .md-hero{flex-direction:column;align-items:flex-start;text-align:center}
            .md-controls{width:100%;justify-content:center}
        }
    </style>

    <div class="md-hero">
        <div class="left">
            <h2 id="products-title">Produits</h2>
            <div class="subtitle">Gestion des produits — pagination optionnelle</div>
        </div>
        <div class="md-controls">
            <input id="productsSearch" class="md-input" placeholder="Rechercher produit ou catégorie...">
            <button id="productsReload" class="md-btn secondary">Recharger</button>
            <button id="productsNew" class="md-btn">Nouveau</button>
        </div>
    </div>

    <div class="md-grid">
        <div class="md-table" role="region" aria-labelledby="products-title">
            <table class="md" aria-describedby="products-desc">
                <thead>
                    <tr>
                        <th style="width:70px">ID</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th style="width:110px">Prix</th>
                        <th style="width:100px">Commandes</th>
                        <th style="width:120px">Revenu</th>
                        <th style="width:120px">Disponible</th>
                        <th style="width:140px">Actions</th>
                    </tr>
                </thead>
                <tbody id="productsBody"><tr><td colspan="8" class="muted">Chargement...</td></tr></tbody>
            </table>
            <div id="productsPagination" class="pagination" aria-hidden="true"></div>
        </div>

        <!-- Cards for mobile -->
        <div id="productsCards" class="cards-mobile">
            <div id="productsCardsList"><!-- cards injected here --></div>
            <div id="productsPaginationMobile" class="pagination" aria-hidden="true"></div>
        </div>
    </div>

    <!-- Snackbar for non-blocking messages -->
    <div id="mdSnackbar" aria-live="polite" style="position:fixed;right:16px;bottom:16px;z-index:2000;display:none"></div>

    <script>
    (function(){
        const univ = new URLSearchParams(window.location.search).get('univ') || '1';
        const base = `/kodpwomo/backend/products/adm`;
        let lastData = null;

        function escapeHtml(s){ return s===null||s===undefined? '': String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
        function fmtNum(n){ if(n===null||n===undefined) return '0'; return Number(n).toLocaleString(); }
        function fmtMoney(n){ if(n===null||n===undefined) return '-'; return fmtNum(n)+' FC'; }

        function showSnack(msg, timeout=4000){
            const sn = document.getElementById('mdSnackbar'); 
            sn.innerHTML = `<span style="margin-right:8px">💎</span>${msg}`;
            sn.style.display = 'block';
            clearTimeout(window._mdSnackTimer);
            window._mdSnackTimer = setTimeout(()=>{ sn.style.display='none'; }, timeout);
        }

        async function fetchProducts(page=null, search=''){
            let url;
            if(page){ url = `${base}/${univ}/page/${page}` + (search? `/${encodeURIComponent(search)}` : ''); }
            else { url = `${base}/${univ}` + (search? `/search/${encodeURIComponent(search)}` : ''); }
            try{
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const txt = await res.text(); if(!txt) throw new Error('empty response');
                const data = JSON.parse(txt);
                lastData = data;
                const list = data.products || data.items || [];
                render(list, data.pagination || data);
            }catch(e){
                document.getElementById('productsBody').innerHTML = `<tr><td colspan="8" class="muted">Erreur: ${escapeHtml(e.message)}</td></tr>`;
                showSnack('Erreur lors du chargement des produits');
            }
        }

        function render(list, pagination){
            const body = document.getElementById('productsBody'); body.innerHTML = '';
            const cardsRoot = document.getElementById('productsCardsList'); cardsRoot.innerHTML = '';
            if(!list || !list.length){ body.innerHTML = `<tr><td colspan="8" class="muted">Aucun produit</td></tr>`; renderPagination(null); renderPaginationMobile(null); return }

            // Table rows
            for(const p of list){
                const tr = document.createElement('tr');
                const avail = Number(p.is_available) ? true : false;
                const availClass = avail ? 'chip success' : 'chip warn';
                tr.innerHTML = `
                    <td>${escapeHtml(p.id)}</td>
                    <td>${escapeHtml(p.name)}</td>
                    <td>${escapeHtml(p.category_name||'')}</td>
                    <td>${fmtMoney(p.prices||p.price)}</td>
                    <td>${fmtNum(p.total_orders||0)}</td>
                    <td>${p.total_revenue ? fmtMoney(p.total_revenue) : '-'}</td>
                    <td><span class="${availClass}">${avail? 'Oui':'Non'}</span></td>
                    <td>
                        <div style="display:flex;gap:4px;align-items:center">
                            <button class="product-edit-btn" data-product-id="${escapeHtml(p.id)}">Modifier</button>
                            <button class="md-toggle" data-id="${escapeHtml(p.id)}" data-avail="${avail?1:0}">Basculer</button>
                        </div>
                    </td>
                `;
                body.appendChild(tr);

                // Mobile card
                const card = document.createElement('div'); card.className='md-card';
                card.innerHTML = `
                    <div class="avatar">${escapeHtml(String(p.id))}</div>
                    <div class="meta">
                        <div class="title">${escapeHtml(p.name)}</div>
                        <div class="sub">${escapeHtml(p.category_name||'')} — ${fmtMoney(p.prices||p.price)}</div>
                    </div>
                    <div style="text-align:right;display:flex;flex-direction:column;gap:8px">
                        <span class="${availClass}">${avail? 'Disponible':'Indisponible'}</span>
                        <div style="display:flex;gap:4px">
                            <button class="product-edit-btn" data-product-id="${escapeHtml(p.id)}">Modifier</button>
                            <button class="md-toggle" data-id="${escapeHtml(p.id)}" data-avail="${avail?1:0}">Basculer</button>
                        </div>
                    </div>
                `;
                cardsRoot.appendChild(card);
            }

            renderPagination(pagination);
            renderPaginationMobile(pagination);

            // attach edit handlers
            addEditButtons();

            // attach toggle handlers
            document.querySelectorAll('.md-toggle').forEach(b=>{
                if(b._bound) return; b._bound = true;
                b.addEventListener('click', async ()=>{
                    const id = b.getAttribute('data-id');
                    const cur = b.getAttribute('data-avail')==='1'; const next = !cur;
                    const prevText = b.textContent; b.textContent = '…'; b.disabled = true;
                    try{
                        const putUrl = `/kodpwomo/backend/products/availability`;
                        const res = await fetch(putUrl, { method: 'PUT', headers: {'Content-Type':'application/json','Accept':'application/json'}, body: JSON.stringify({ id: id, is_available: next?1:0 }) });
                        const txt = await res.text(); const json = txt? JSON.parse(txt): {};
                        showSnack('Mise à jour effectuée');
                        await fetchProducts();
                    }catch(e){ showSnack('Erreur mise à jour: '+(e.message||e)); }
                    finally{ b.disabled = false; b.textContent = prevText }
                })
            })
        }

        function renderPagination(p){
            const el = document.getElementById('productsPagination'); el.innerHTML=''; if(!p || (!p.total_pages && !p.total && !p.total_products)) { el.setAttribute('aria-hidden','true'); return }
            el.setAttribute('aria-hidden','false');
            const current = p.current_page || 1; const total = p.total_pages || p.total_products || p.total || 1;
            const prev=document.createElement('button'); prev.textContent='<'; prev.disabled=true; el.appendChild(prev);
            const start=Math.max(1,current-2); const end=Math.min(total,start+4);
            for(let i=start;i<=end;i++){ const b=document.createElement('button'); b.textContent=i; if(i===current) b.style.fontWeight='800'; b.disabled=true; el.appendChild(b) }
            const next=document.createElement('button'); next.textContent='>'; next.disabled=true; el.appendChild(next);
        }

        function renderPaginationMobile(p){
            const el = document.getElementById('productsPaginationMobile'); el.innerHTML=''; if(!p || (!p.total_pages && !p.total && !p.total_products)) { el.setAttribute('aria-hidden','true'); return }
            el.setAttribute('aria-hidden','false');
            const current = p.current_page || 1; const total = p.total_pages || p.total_products || p.total || 1;
            const prev=document.createElement('button'); prev.textContent='Prev'; prev.disabled=true; el.appendChild(prev);
            const info = document.createElement('div'); info.textContent = `Page ${current} / ${total}`; info.style.alignSelf='center'; el.appendChild(info);
            const next=document.createElement('button'); next.textContent='Next'; next.disabled=true; el.appendChild(next);
        }

        document.getElementById('productsReload').addEventListener('click', ()=> fetchProducts());
        document.getElementById('productsNew').addEventListener('click', ()=> openProductModal());

        let prodTimer=null; document.getElementById('productsSearch').addEventListener('input', ()=>{ clearTimeout(prodTimer); prodTimer=setTimeout(()=> fetchProducts(null, document.getElementById('productsSearch').value||''), 350); });

        // Product Modal Functions
        window.openProductModal = function(productData = null) {
            const isEdit = productData !== null;
            createProductModal(isEdit ? 'Modifier le produit' : 'Nouveau produit', productData);
        }

        function createProductModal(title, productData = null) {
            // Remove existing modal if any
            const existingModal = document.getElementById('productModal');
            if (existingModal) existingModal.remove();

            const isEdit = productData !== null;
            
            // Create modal HTML
            const modalHTML = `
                <div id="productModal" class="product-modal-overlay">
                    <div class="product-modal-content">
                        <div class="product-modal-header">
                            <h3>${title}</h3>
                            <button type="button" class="product-modal-close" onclick="closeProductModal()">&times;</button>
                        </div>
                        <form id="productForm" class="product-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="productName">Nom du produit *</label>
                                    <input type="text" id="productName" name="name" required 
                                           value="${isEdit ? escapeHtml(productData.name) : ''}"
                                           placeholder="Nom du produit">
                                </div>
                                <div class="form-group">
                                    <label for="productCategory">Catégorie *</label>
                                    <select id="productCategory" name="category_id" required>
                                        <option value="">Sélectionner une catégorie</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="productPrice">Prix (FC) *</label>
                                    <input type="number" id="productPrice" name="price" required min="0" step="0.01"
                                           value="${isEdit ? (productData.prices || productData.price || '') : ''}"
                                           placeholder="0.00">
                                </div>
                                <div class="form-group">
                                    <label for="productAvailable">Disponible</label>
                                    <select id="productAvailable" name="is_available">
                                        <option value="1" ${isEdit && Number(productData.is_available) ? 'selected' : ''}>Oui</option>
                                        <option value="0" ${isEdit && !Number(productData.is_available) ? 'selected' : ''}>Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Description</label>
                                <textarea id="productDescription" name="description" rows="3" 
                                          placeholder="Description du produit">${isEdit ? escapeHtml(productData.description || '') : ''}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="productImage">Image du produit</label>
                                <div class="image-upload-container">
                                    <input type="file" id="productImage" name="image" accept="image/*" class="image-input">
                                    <div class="image-preview-container">
                                        <div id="imagePreview" class="image-preview">
                                            ${isEdit && productData.image_url ? 
                                                `<img src="${escapeHtml(productData.image_url)}" alt="Product image">` : 
                                                '<div class="image-placeholder">Aucune image</div>'
                                            }
                                        </div>
                                        <div class="image-actions">
                                            <button type="button" class="btn-select-image" onclick="document.getElementById('productImage').click()">
                                                Choisir une image
                                            </button>
                                            <button type="button" class="btn-remove-image" onclick="removeProductImage()">
                                                Supprimer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-cancel" onclick="closeProductModal()">Annuler</button>
                                <button type="submit" class="btn-submit" id="productSubmitBtn">
                                    ${isEdit ? 'Modifier' : 'Créer'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);
            
            // Load categories and setup handlers
            loadCategories(isEdit ? productData.category_id : null);
            setupModalHandlers(isEdit, productData);
        }

        async function loadCategories(selectedCategoryId = null) {
            try {
                const response = await fetch('/kodpwomo/backend/categories', {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();
                const select = document.getElementById('productCategory');
                
                // Clear existing options except first
                select.innerHTML = '<option value="">Sélectionner une catégorie</option>';
                
                if (data.categories && Array.isArray(data.categories)) {
                    data.categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        if (selectedCategoryId && category.id == selectedCategoryId) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                }
            } catch (error) {
                showSnack('Erreur lors du chargement des catégories');
            }
        }

        function setupModalHandlers(isEdit, productData) {
            // Image upload handler
            document.getElementById('productImage').addEventListener('change', handleImageUpload);
            
            // Form submit handler
            document.getElementById('productForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                await submitProductForm(isEdit, productData);
            });

            // ESC key to close modal
            document.addEventListener('keydown', handleEscKey);
        }

        function handleImageUpload(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.startsWith('image/')) {
                showSnack('Veuillez sélectionner une image valide');
                e.target.value = '';
                return;
            }

            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                showSnack('L\'image ne doit pas dépasser 2MB');
                e.target.value = '';
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.getElementById('imagePreview');
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }

        function removeProductImage() {
            document.getElementById('productImage').value = '';
            document.getElementById('imagePreview').innerHTML = '<div class="image-placeholder">Aucune image</div>';
        }

        async function submitProductForm(isEdit, productData) {
            const submitBtn = document.getElementById('productSubmitBtn');
            const originalText = submitBtn.textContent;
            
            try {
                submitBtn.textContent = 'En cours...';
                submitBtn.disabled = true;

                const formData = new FormData();
                const form = document.getElementById('productForm');
                
                // Add form fields
                formData.append('name', document.getElementById('productName').value.trim());
                formData.append('category_id', document.getElementById('productCategory').value);
                formData.append('price', document.getElementById('productPrice').value);
                formData.append('is_available', document.getElementById('productAvailable').value);
                formData.append('description', document.getElementById('productDescription').value.trim());
                formData.append('university_id', univ);

                if (isEdit) {
                    formData.append('id', productData.id);
                }

                // Add image if selected
                const imageFile = document.getElementById('productImage').files[0];
                if (imageFile) {
                    formData.append('image', imageFile);
                }

                const url = isEdit ? '/kodpwomo/backend/products' : '/kodpwomo/backend/products';
                const method = isEdit ? 'PUT' : 'POST';
                
                const response = await fetch(url, {
                    method: method,
                    body: formData
                });

                const result = await response.json();
                
                if (response.ok && result.success) {
                    showSnack(isEdit ? 'Produit modifié avec succès' : 'Produit créé avec succès');
                    closeProductModal();
                    fetchProducts(); // Refresh the list
                } else {
                    throw new Error(result.message || 'Erreur lors de la sauvegarde');
                }

            } catch (error) {
                showSnack('Erreur: ' + error.message);
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        }

        window.closeProductModal = function() {
            const modal = document.getElementById('productModal');
            if (modal) {
                modal.remove();
                document.removeEventListener('keydown', handleEscKey);
            }
        }

        function handleEscKey(e) {
            if (e.key === 'Escape') {
                closeProductModal();
            }
        }

        // Add edit functionality to existing products
        function addEditButtons() {
            // This will be called after render to add edit buttons to each product
            document.querySelectorAll('.product-edit-btn').forEach(btn => {
                if (btn._editBound) return;
                btn._editBound = true;
                
                btn.addEventListener('click', () => {
                    const productId = btn.getAttribute('data-product-id');
                    const product = lastData.products?.find(p => p.id == productId) || 
                                   lastData.items?.find(p => p.id == productId);
                    if (product) {
                        openProductModal(product);
                    }
                });
            });
        }

        // initial load
        fetchProducts();
    })();
    </script>

    <!-- Product Modal Styles -->
    <style>
        .product-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .product-modal-content {
            background: var(--local-surface);
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 2px solid var(--local-secondary);
        }

        .product-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 2px solid var(--local-secondary);
            background: linear-gradient(135deg, var(--local-primary), var(--local-secondary));
        }

        .product-modal-header h3 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
        }

        .product-modal-close {
            background: none;
            border: none;
            font-size: 24px;
            color: white;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .product-modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .product-form {
            padding: 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: var(--local-text);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--local-secondary);
            border-radius: 12px;
            background: var(--local-surface);
            color: var(--local-text);
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--local-accent);
            box-shadow: 0 0 0 3px rgba(69, 183, 209, 0.2);
        }

        .image-upload-container {
            border: 2px dashed var(--local-secondary);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: border-color 0.3s ease;
        }

        .image-upload-container:hover {
            border-color: var(--local-accent);
        }

        .image-input {
            display: none;
        }

        .image-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .image-preview {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid var(--local-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--local-surface-dim);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-placeholder {
            color: var(--local-text-muted);
            font-size: 0.9rem;
        }

        .image-actions {
            display: flex;
            gap: 8px;
        }

        .btn-select-image,
        .btn-remove-image {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-select-image {
            background: linear-gradient(135deg, var(--local-primary), var(--local-secondary));
            color: white;
        }

        .btn-select-image:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--local-shadow);
        }

        .btn-remove-image {
            background: var(--local-surface);
            border: 2px solid var(--local-danger);
            color: var(--local-danger);
        }

        .btn-remove-image:hover {
            background: var(--local-danger);
            color: white;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 2px solid var(--local-secondary);
        }

        .btn-cancel,
        .btn-submit {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: var(--local-surface);
            border: 2px solid var(--local-text-muted);
            color: var(--local-text-muted);
        }

        .btn-cancel:hover {
            background: var(--local-text-muted);
            color: white;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--local-success), var(--local-accent));
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px var(--local-shadow);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .product-edit-btn {
            background: linear-gradient(135deg, var(--local-info), var(--local-accent));
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .product-edit-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px var(--local-shadow);
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .product-modal-content {
                width: 95%;
                margin: 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</section>
