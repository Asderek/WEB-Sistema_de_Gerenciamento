<?php
							
		include('../../newconexao.php');
		
		$matricula = $_POST['matricula'];
		
		$sqlAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
		$queryAluno = $conexao->query($sqlAluno);
		if ($queryAluno!=false)
		{
			$resultAluno = $queryAluno->fetchAll(PDO::FETCH_ASSOC);
			$rowsAluno = count($resultAluno);
		}	
		
		$sqlReSend = "SELECT * FROM avaliacao WHERE matricula = $matricula";
		$queryReSend = $conexao->query($sqlReSend);
		if ($queryReSend == false)
		{
			echo "ERRO<br>";
			return;
		}
		$resultReSend = $queryReSend->fetchAll(PDO::FETCH_ASSOC);
		$rowsReSend = count($resultReSend);		
		
		if ($rowsReSend>0)
		{
			echo '<h5 class="text-center">Avaliação Já Foi Cadastrada</h5>';
			echo '<br>';
		}
		if($rowsAluno <= 0)
		{
			echo '<h5 class="text-center">Aluno não está cadastrado no EMA</h5>';
			echo '<br>';
			echo '<a href="mainMonitor.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
		}
		else 
		{
			$professor = $resultAluno[0]['professor'];
			$professor = strtolower($professor);
			$professor = ucfirst($professor);
			
			$disciplina = $resultAluno[0]['disciplina'];
			$turma = $resultAluno[0]['turma'];
			
			$professores[0] = $adriano = "Adriano Barcelos Romeiro";
			$professores[1] = $agnes = "Agnes Christian Chaves Faria";
			$professores[2] = $assed = "Alexandre Servino Assed";
			$professores[3] = $anaLuisa = "Ana Luisa de Melo";
			$professores[4] = $anaPaula = "Ana Paula S. P. de C. Almeida";
			$professores[5] = $perecmanis = "Andre Perecmanis";
			$professores[6] = $beatriz = "Beatriz da Silva Roland";
			$professores[7] = $breno = "Breno Melaragno Costa";
			$professores[8] = $bruno = "Bruno Machado Eiras";
			$professores[9] = $carlos = "Carlos Raymundo Cardoso";
			$professores[10] = $daniela = "Daniela da Rocha Brandao";
			$professores[11] = $denise = "Denise Muller dos Reis Pupo";
			$professores[12] = $felipe = "Felipe Girdwood Acioli";
			$professores[13] = $fernanda = "Fernanda Leite Mendes";
			$professores[14] = $ines = "Ines Alegria Rocumback";
			$professores[15] = $ivan = "Ivan Firmino Santiago";
			$professores[16] = $job = "Job Eloisio Vieira Gomes";
			$professores[17] = $juliana = "Juliana Bracks Duarte";
			$professores[18] = $pedroMatias = "Pedro Matias da Costa Filho";
			$professores[19] = $samantha = "Samantha Pelajo";
			$professores[20] = $rafael = "Rafael da Mota Mendonca";
			
			
			$i=0;
			for($i=0;$i<21;$i++)
			{
				$nome = strstr($professores[$i],' ',true);
				
				if (strstr ($professor,' ',true) == $nome)
				{
					if ($nome == "Ana")
					{
						if ($i == 3)
							if(strpos ($professor,"DE S ") == true)
							{
								break;
							}
						else if ($i == 4)
							if(strpos ($professor,"DE C ") == true)
							{
								break;
							}
					}
					break;
				}
			}
			
			$disciplinas[0] = "JUR1961";
			$disciplinas[1] = "JUR1962";
			$disciplinas[2] = "JUR1963";
			$disciplinas[3] = "JUR1964";									

			$turmas[0] = "2HA";
			$turmas[1] = "2HB";
			$turmas[2] = "2HC";
			$turmas[3] = "2HD";	
			$turmas[4] = "2HE";
			$turmas[5] = "2HF";
			$turmas[6] = "2HG";
			$turmas[7] = "2HH";	
			$turmas[8] = "2HX";


			echo '

			<div class="form-group">
				<label for="NameEMA">EMA: </label>
				<select class="form-control" id="ema" name="ema">';
			
			
			for($j=0;$j<4;$j++)
			{
				if($rowsReSend>0)
				{
					if ($disciplinas[$j] == mysql_result($queryReSend,0,'disciplina'))
						echo '<option selected value="'.$disciplinas[$j].'">'.$disciplinas[$j].'</option>';
					else
						echo '<option value="'.$disciplinas[$j].'">'.$disciplinas[$j].'</option>';
				}
				else 
				{
					if($disciplinas[$j] == $disciplina)
						echo '<option selected value="'.$disciplinas[$j].'">'.$disciplinas[$j].'</option>';
					else
						echo '<option value="'.$disciplinas[$j].'">'.$disciplinas[$j].'</option>';
				}
			}
				
			
					
			echo '
				</select>
			</div>';
				
			echo '

			<div class="form-group">
				<label for="NameEMA">Turma: </label>
				<select class="form-control" id="turma" name="turma">';
			
			
			for($j=0;$j<9;$j++)
			{
				if($rowsReSend>0)
				{
					if ($turmas[$j] == mysql_result($queryReSend,0,'turma'))
						echo '<option selected value="'.$turmas[$j].'">'.$turmas[$j].'</option>';
					else
						echo '<option value="'.$turmas[$j].'">'.$turmas[$j].'</option>';
				}
				else 
				{
					if($turmas[$j] == $turma)
						echo '<option selected value="'.$turmas[$j].'">'.$turmas[$j].'</option>';
					else
						echo '<option value="'.$turmas[$j].'">'.$turmas[$j].'</option>';
				}
			}									
					
			echo '
				</select>
			</div>
			
			<div class="form-group">
				<label for="NameProfessor">Professor: </label>
				<select class="form-control" id="professor" name="professor">';
			
			
			for($j=0;$j<21;$j++)
			{
				if($rowsReSend>0)
				{
					if ($professores[$j] == mysql_result($queryReSend,0,'professor'))
						echo '<option selected value="'.$professores[$j].'">'.$professores[$j].'</option>';
					else
						echo '<option value="'.$professores[$j].'">'.$professores[$j].'</option>';
				}
				else 
				{
					if($j==$i)
						echo '<option selected value="'.$professores[$j].'">'.$professores[$j].'</option>'; 
					else	
						echo '<option value="'.$professores[$j].'">'.$professores[$j].'</option>'; 
				}
			}
			
			if ($rowsReSend<= 0)
			{
				echo '
					</select>
				</div>
				
				<label> Como você avaliaria a estrutura (Computador, material, espaço físico) do Núcleo de Prática Jurídica?</label>
				<br>
				<div>
								<input type="radio" id="P1" name="P1" value="1" checked> Prefiro não responder<br>
								<input type="radio" id="P1" name="P1" value="2"> Ótima<br>
								<input type="radio" id="P1" name="P1" value="3"> Muito boa<br>
								<input type="radio" id="P1" name="P1" value="4"> Boa<br>
								<input type="radio" id="P1" name="P1" value="5"> Regular<br>
								<input type="radio" id="P1" name="P1" value="6"> Ruim<br>
				</div>
				<label> Deixe seu comentário sobre a estrutura do Núcleo de Prática Jurídica:</label>
				<textarea id="P1text" name="P1text" style="width: 100%" rows="5"></textarea>
				<br>
				<label> Como você avaliaria os horários oferecidos para os plantões do Núcleo de Prática Jurídica?</label>
				<br>
				<div>
								<input type="radio" id="P2" name="P2" value="1" checked> Prefiro não responder<br>
								<input type="radio" id="P2" name="P2" value="2"> Ótimo<br>
								<input type="radio" id="P2" name="P2" value="3"> Muito bom<br>
								<input type="radio" id="P2" name="P2" value="4"> Bom<br>
								<input type="radio" id="P2" name="P2" value="5"> Regular<br>
								<input type="radio" id="P2" name="P2" value="6"> Ruim<br>
				</div>
				<label> Deixe seu comentário sobre os horários disponiveis para plantão:</label>
				<textarea id="P2text" name="P2text" style="width: 100%" rows="5"></textarea>
				<br>
				<label> Como você avaliaria a pontualidade e a assiduidade do seu professor do plantão?</label>
				<br>
				<div>
								<input type="radio" id="P3" name="P3" value="1" checked> Prefiro não responder<br>
								<input type="radio" id="P3" name="P3" value="2"> Ótimas<br>
								<input type="radio" id="P3" name="P3" value="3"> Muito boas<br>
								<input type="radio" id="P3" name="P3" value="4"> Boas<br>
								<input type="radio" id="P3" name="P3" value="5"> Regulares<br>
								<input type="radio" id="P3" name="P3" value="6"> Ruins<br>
				</div>
				<label> Deixe seu comentário sobre o seu professor de plantão:</label>
				<textarea id="P3text" name="P3text" style="width: 100%" rows="5"></textarea>
				<br>
				<label> Como você avaliaria o desempenho do monitor do plantão?</label>
				<br>
				<div>
								<input type="radio" id="P4" name="P4" value="1" checked> Prefiro não responder<br>
								<input type="radio" id="P4" name="P4" value="2"> Ótimo<br>
								<input type="radio" id="P4" name="P4" value="3"> Muito bom<br>
								<input type="radio" id="P4" name="P4" value="4"> Bom<br>
								<input type="radio" id="P4" name="P4" value="5"> Regular<br>
								<input type="radio" id="P4" name="P4" value="6"> Ruim<br>
				</div>
				<label> Deixe seu comentário sobre o monitor do plantão:</label>
				<textarea id="P4text" name="P4text" style="width: 100%" rows="5"></textarea>
				<br>
				<label> Entende que as suas atividades no Núcleo, incluindo atendimentos aos assistidos, contribuem de alguma forma para sua formação profissional?</label>
				<br>
				<div>
								<input type="radio" id="P5" name="P5" value="1" checked> Prefiro não responder<br>
								<input type="radio" id="P5" name="P5" value="2"> Sim<br>
								<input type="radio" id="P5" name="P5" value="3"> Não<br>
				</div>
				<label> Deixe seu comentário sobre a sua experiência no Núcleo de Prática Jurídica:</label>
				<textarea id="P5text" name="P5text" style="width: 100%" rows="5"></textarea>
				<br>
				
				
				
				<br>
				';
			}
			else
			{
				
				/*P1*/
				echo '
					</select>
				</div>
				
				<label> Como você avaliaria a estrutura (Computador, material, espaço físico) do Núcleo de Prática Jurídica?</label>
				<br>
				<div>
								<input type="radio" id="P1" name="P1" value="1" ';
					
				if(mysql_result($queryReSend,0,'p1') == 1)
				{
					echo 'checked';
				}											
				
				echo '> Prefiro não responder<br>
								<input type="radio" id="P1" name="P1" value="2" ';
								
				if(mysql_result($queryReSend,0,'p1') == 2)
				{
					echo 'checked';
				}					
								
				echo '> Ótima<br>
								<input type="radio" id="P1" name="P1" value="3" ';
								
				if(mysql_result($queryReSend,0,'p1') == 3)
				{
					echo 'checked';
				}					
								
				echo '> Muito boa<br>
								<input type="radio" id="P1" name="P1" value="4" ';
					
				if(mysql_result($queryReSend,0,'p1') == 4)
				{
					echo 'checked';
				}											
				
				echo '> Boa<br>
								<input type="radio" id="P1" name="P1" value="5" ';
								
				if(mysql_result($queryReSend,0,'p1') == 5)
				{
					echo 'checked';
				}					
								
				echo '> Regular<br>
								<input type="radio" id="P1" name="P1" value="6" ';
								
				if(mysql_result($queryReSend,0,'p1') == 6)
				{
					echo 'checked';
				}					
								
				echo '> Ruim<br>
				</div>
				<label> Deixe seu comentário sobre a estrutura do Núcleo de Prática Jurídica:</label>
				<textarea id="P1text" name="P1text" style="width: 100%" rows="5">';
				
				echo mysql_result($queryReSend,0,'p1text');
				
				
				
				
				/*P2*/
				echo '</textarea>
				<br>
				<label> Como você avaliaria os horários oferecidos para os plantões do NPJ?</label>
				<br>
				<div>
								<input type="radio" id="P2" name="P2" value="1" ';
					
				if(mysql_result($queryReSend,0,'p2') == 1)
				{
					echo 'checked';
				}											
				
				echo '> Prefiro não responder<br>
								<input type="radio" id="P2" name="P2" value="2" ';
								
				if(mysql_result($queryReSend,0,'p2') == 2)
				{
					echo 'checked';
				}					
								
				echo '> Ótimo<br>
								<input type="radio" id="P2" name="P2" value="3" ';
								
				if(mysql_result($queryReSend,0,'p2') == 3)
				{
					echo 'checked';
				}					
								
				echo '> Muito bom<br>
								<input type="radio" id="P2" name="P2" value="4" ';
					
				if(mysql_result($queryReSend,0,'p2') == 4)
				{
					echo 'checked';
				}											
				
				echo '> Bom<br>
								<input type="radio" id="P2" name="P2" value="5" ';
								
				if(mysql_result($queryReSend,0,'p2') == 5)
				{
					echo 'checked';
				}					
								
				echo '> Regular<br>
								<input type="radio" id="P2" name="P2" value="6" ';
								
				if(mysql_result($queryReSend,0,'p2') == 6)
				{
					echo 'checked';
				}					
								
				echo '> Ruim<br>
				</div>
				<label> Deixe seu comentário sobre os horários disponiveis para plantão:</label>
				<textarea id="P2text" name="P2text" style="width: 100%" rows="5">';
				
				echo mysql_result($queryReSend,0,'p2text');
				
				
				/*P3*/
				
				echo '</textarea>
				<br>
				<label> Como você avaliaria a pontualidade e a assiduidade do seu professor do plantão?</label>
				<br>
				<div>
								<input type="radio" id="P3" name="P3" value="1" ';
					
				if(mysql_result($queryReSend,0,'p3') == 1)
				{
					echo 'checked';
				}											
				
				echo '> Prefiro não responder<br>
								<input type="radio" id="P3" name="P3" value="2" ';
								
				if(mysql_result($queryReSend,0,'p3') == 2)
				{
					echo 'checked';
				}					
								
				echo '> Ótimas<br>
								<input type="radio" id="P3" name="P3" value="3" ';
								
				if(mysql_result($queryReSend,0,'p3') == 3)
				{
					echo 'checked';
				}					
								
				echo '> Muito boas<br>
								<input type="radio" id="P3" name="P3" value="4" ';
					
				if(mysql_result($queryReSend,0,'p3') == 4)
				{
					echo 'checked';
				}											
				
				echo '> Boas<br>
								<input type="radio" id="P3" name="P3" value="5" ';
								
				if(mysql_result($queryReSend,0,'p3') == 5)
				{
					echo 'checked';
				}					
								
				echo '> Regulares<br>
								<input type="radio" id="P3" name="P3" value="6" ';
								
				if(mysql_result($queryReSend,0,'p3') == 6)
				{
					echo 'checked';
				}					
								
				echo '> Ruins<br>
				</div>
				<label> Deixe seu comentário sobre o seu professor de plantão:</label>
				<textarea id="P3text" name="P3text" style="width: 100%" rows="5">';
				
				echo mysql_result($queryReSend,0,'p3text');
				
				
				/*P4*/
				echo '</textarea>
				<br>
				<label> Como você avaliaria o desempenho do monitor do plantão?</label>
				<br>
				<div>
								<input type="radio" id="P4" name="P4" value="1" ';
					
				if(mysql_result($queryReSend,0,'p4') == 1)
				{
					echo 'checked';
				}											
				
				echo '> Prefiro não responder<br>
								<input type="radio" id="P4" name="P4" value="2" ';
								
				if(mysql_result($queryReSend,0,'p4') == 2)
				{
					echo 'checked';
				}					
								
				echo '> Ótimo<br>
								<input type="radio" id="P4" name="P4" value="3" ';
								
				if(mysql_result($queryReSend,0,'p4') == 3)
				{
					echo 'checked';
				}					
								
				echo '> Muito bom<br>
								<input type="radio" id="P4" name="P4" value="4" ';
					
				if(mysql_result($queryReSend,0,'p4') == 4)
				{
					echo 'checked';
				}											
				
				echo '> Bom<br>
								<input type="radio" id="P4" name="P4" value="5" ';
								
				if(mysql_result($queryReSend,0,'p4') == 5)
				{
					echo 'checked';
				}					
								
				echo '> Regular<br>
								<input type="radio" id="P4" name="P4" value="6" ';
								
				if(mysql_result($queryReSend,0,'p4') == 6)
				{
					echo 'checked';
				}					
								
				echo '> Ruim<br>
				</div>
				<label> Deixe seu comentário sobre o monitor do plantão:</label>
				<textarea id="P4text" name="P4text" style="width: 100%" rows="5">';
				
				echo mysql_result($queryReSend,0,'p4text');
				
				
				/*P5*/
				
				echo '</textarea>
				<br>
				<label> Entende que as suas atividades no Núcleo, incluindo atendimentos aos assistidos, contribuem de alguma forma para sua formação profissional?</label>
				<br>
				<div>
								<input type="radio" id="P5" name="P5" value="1" ';
					
				if(mysql_result($queryReSend,0,'p5') == 1)
				{
					echo 'checked';
				}											
				
				echo '> Prefiro não responder<br>
								<input type="radio" id="P5" name="P5" value="2" ';
								
				if(mysql_result($queryReSend,0,'p5') == 2)
				{
					echo 'checked';
				}					
								
				echo '> Sim<br>
								<input type="radio" id="P5" name="P5" value="3" ';
								
				if(mysql_result($queryReSend,0,'p5') == 3)
				{
					echo 'checked';
				}					
								
				echo '> Não<br>
				</div>
				<label> Deixe seu comentário sobre a sua experiência no Núcleo de Prática Jurídica:</label>
				<textarea id="P5text" name="P5text" style="width: 100%" rows="5">';
				
				echo mysql_result($queryReSend,0,'p5text');
				
				/*END*/
				
				echo '</textarea>
				
				<br>
				';
			}
	}
?>