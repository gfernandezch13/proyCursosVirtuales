select * from ESTUDIANTE

select c.nombre as curso, count(m.*) as nro_mat
from matricula m inner join grupo_academico g on (m.codigo_grupo = g.codigo_grupo)
inner join curso c on (c.codigo = g.codigo_curso)
group by c.nombre

select c.nombre as CURSO, g.descripcion as GRU.ACA, m.fecha_registro as F.MAT, 
from grupo_academico