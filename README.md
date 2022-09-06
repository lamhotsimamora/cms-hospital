# cms-hospital

User : rslgmco1_admin_2022

Database : rslgmco1_db_cms_2022
Password : ZdB[lc4SgwM=




		 <?php

		
		foreach ($data_docter as $key => $value) {
			$foto = $value['foto'];
			$nama = $value['nama'];

			if ($foto==='' || $foto==null)
			{
				$foto = $no_img;
			}else{
				$foto =  $server.'public/img/docters/'.$foto;
			}

			echo '<li class="thumbnail">
					<img width="60" height="60" src="'  . $foto . '" alt="" />
				</li>';
		}

		?> 
