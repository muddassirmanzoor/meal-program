 <!-- <script type="text/javascript">
        function initMap() {
            
            
            
            center = { lat: 29.930279, lng: 70.659232 };
            zoom = 8;
            // Initialize map with dynamic center and zoom
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: zoom,
                center: center,
            });


            const markerIcons = {
            'Male Primary': '/img/pins/male-p.png',
            'MALE PRIMARY': '/img/pins/male-p.png',
            'MALE ELEMENTARY': '/img/pins/male-md.png',
            'Male sMosque': '/img/pins/male-p.png',
            'Female Primary': '/img/pins/female-p.png',
            'FEMALE PRIMARY': '/img/pins/female-p.png',
            'FEMALE ELEMENTARY': '/img/pins/female-md.png',
            'Male Middle': '/img/pins/male-md.png',
            'Female Middle': '/img/pins/female-md.png',
            'Male High': '/img/pins/male-h.png',
            'MALE HIGH': '/img/pins/male-h.png',
            'Female High': '/img/pins/female-h.png',
            'FEMALE HIGH': '/img/pins/female-h.png',
            'Male H.Sec.': '/img/pins/male-hs.png',
            'Female H.Sec.': '/img/pins/female-hs.png',
            'MALE H.Sec.': '/img/pins/male-hs.png',
            'FEMAL H.Sec.': '/img/pins/female-hs.png',
            };

            // Create legends panel
            const legendsPanel = document.createElement('div');
            legendsPanel.classList.add('legends-panel');
            legendsPanel.innerHTML = `
                <div><img src="/img/pins/male-p.png"> Boys Primary</div>
                <div><img src="/img/pins/female-p.png"> Girls Primary</div>
            
            `;

            // Append toggle button and legends panel to map
            //map.controls[google.maps.ControlPosition.RIGHT_TOP].push(toggleButton);
            map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legendsPanel);
            
            





            // Get schools data passed from the controller
            const schools = {!! json_encode($schools) !!};
            let openInfoWindow = null;
            // Loop through schools data and add markers to the map
            schools.forEach(function(school) {
                const markerIcon = markerIcons[`${school.gender} ${school.level}`];

                const marker = new google.maps.Marker({
                    position: { lat: parseFloat(school.s_lat), lng: parseFloat(school.s_lng) },
                    map: map,
                    title: school.school_name,
                    icon: markerIcon
                });

                // Add info window to the marker
                const infoWindow = new google.maps.InfoWindow({
                    content: createInfoWindowContent(school)
                });

                // Show info window when marker is clicked
                marker.addListener('click', function() {
                    if (openInfoWindow !== null) {
                        openInfoWindow.close();
                    }
                    infoWindow.open(map, marker);
                    openInfoWindow = infoWindow;
                });
            });

            // Attach event listeners outside the loop
            attachEventListeners();
                
        }

        function createInfoWindowContent(school) {
        
        return '<div class="school-info-map-wrapper">' +
                                '<table class="table table-bordered table-striped ">' +
                                '<tr style="background-color: #c5e0ff !important;" ><td colspan="4"><h4 style="text-align:center !important; padding-top:10px;padding-bottom:10px; border-bottom: 2px solid #04578f; color: #04578f;font-weight:bold;" class="school-name-heading">'+ school.s_emis_code + ' - ' +  school.school_name + '</h4></td></tr>' +
                                '<tr><td class="school-info-title">District</td><td class="school-info-vaule">' + school.d_name + '</td></tr>' +
                                '<tr><td class="school-info-title">Tehsil</td><td class="school-info-vaule">' + school.t_name + '</td></tr>' +
                                '<tr><td class="school-info-title">Markaz</td><td class="school-info-vaule">' + school.m_name + '</td></tr>' +
                                '<tr><td class="school-info-title">Gender</td><td class="school-info-vaule">' + school.gender + '</td></tr>' +
                                '<tr><td class="school-info-title">Level</td><td class="school-info-vaule">' + school.level + '</td></tr>' +
                                '<tr><td class="school-info-title">Inventory Received</td><td class="school-info-vaule">' + school.quantity_received + '</td></tr>' +
                                '<tr><td class="school-info-title">Inventory Consumed</td><td class="school-info-vaule">' + school.total_consumed + '</td></tr>' +
                            
                            
                            
                            '<tr style="background-color: #c5e0ff !important;"><td colspan="4"><h4 style="text-align:center !important; padding-top:10px;padding-bottom:10px; border-bottom: 2px solid #04578f; color: #04578f;" class="school-facility-heading"><a href="/school/images/' + school.s_id + '">View Images</a></h4></td></tr>' +
            
                            '</table></div></div>';
        }

        function printTable(school1) {
        
    
        
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>School Info</title>');
            printWindow.document.write('</head><body>');
        // printWindow.document.write(table);
            printWindow.document.write(document.getElementsByClassName('printable')[0].innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }



        function attachEventListeners() {
        // Toggle button
        

            // Legends panel
            const legendsPanel = document.createElement('div');
            legendsPanel.classList.add('legends-panel');
            legendsPanel.innerHTML = `
                <div><img src="/img/pins/male-p.png"> Boys Primary</div>
                <div><img src="/img/pins/female-p.png"> Girls Primary</div>
            
            `;

            map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legendsPanel);
    
        }


        window.initMap = initMap;

    
            

        

       
    </script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
    
