--consulta 1

---VERDADERA

select erp.anio, elec.tipo, ppa.nombre, ppar.partido, round(((sum(erp.alfabetos + erp.analfabetos)::real)*100/tot.tota::real)::numeric,2) total
from eleccion elec, pais ppa, erpm erp,partido ppar, municipio muni, departamento ddepto, (select sum(er.alfabetos + er.analfabetos) tota,
 pp.id_pais,pp.nombre,er.anio, ee.id_eleccion, ee.tipo
from eleccion ee, pais pp, erpm er, departamento depto,municipio mun
where ee.id_eleccion=er.eleccion and er.municipio=mun.id_municipio and mun.departamento=depto.id_depto and depto.pais=pp.id_pais
group by pp.id_pais, er.anio, ee.id_eleccion
order by pp.nombre, er.anio) tot
where erp.municipio=muni.id_municipio and muni.departamento=ddepto.id_depto and ddepto.pais=ppa.id_pais and erp.eleccion=elec.id_eleccion
and erp.partido=ppar.id_partido and ppa.id_pais=tot.id_pais and erp.anio=tot.anio and elec.id_eleccion=tot.id_eleccion
group by erp.anio, elec.tipo, ppa.nombre, ppar.partido, tot.tota
order by erp.anio, ppa.nombre, total desc
--FINAL
SELECT
  * 
FROM (
  SELECT
    ROW_NUMBER() OVER (PARTITION BY nombre ORDER BY total desc) AS r,
    t.*
  FROM
    (select erp.anio, elec.tipo, ppa.nombre, ppar.partido, round(((sum(erp.alfabetos + erp.analfabetos)::real)*100/tot.tota::real)::numeric,2) total
from eleccion elec, pais ppa, erpm erp,partido ppar, municipio muni, departamento ddepto, (select sum(er.alfabetos + er.analfabetos) tota,
 pp.id_pais,pp.nombre,er.anio, ee.id_eleccion, ee.tipo
from eleccion ee, pais pp, erpm er, departamento depto,municipio mun
where ee.id_eleccion=er.eleccion and er.municipio=mun.id_municipio and mun.departamento=depto.id_depto and depto.pais=pp.id_pais
group by pp.id_pais, er.anio, ee.id_eleccion
order by pp.nombre, er.anio) tot
where erp.municipio=muni.id_municipio and muni.departamento=ddepto.id_depto and ddepto.pais=ppa.id_pais and erp.eleccion=elec.id_eleccion
and erp.partido=ppar.id_partido and ppa.id_pais=tot.id_pais and erp.anio=tot.anio and elec.id_eleccion=tot.id_eleccion
group by erp.anio, elec.tipo, ppa.nombre, ppar.partido, tot.tota
order by erp.anio, ppa.nombre, total desc ) t) x
WHERE
  x.r <= 1;

--CONSULTA 2

select sum(alfabetos) total_votos, round(sum(alfabetos)::numeric*100/(select sum(alfabetos + analfabetos)::numeric tot
from erpm er)::numeric,2) porcentaje
from erpm erp, raza ra
where erp.sexo='F' and erp.raza=ra.id_raza and ra.nombre='INDIGENAS' 


---CONUSULTA 3

select ppa.nombre, depto.nombre, sum(erp.analfabetos + erp.alfabetos) total_votos, round((sum(erp.analfabetos + erp.alfabetos)::numeric*100/tot.tt::numeric)::numeric,2) total
from erpm erp, departamento depto, municipio muni, pais ppa, (select ppa.id_pais,ppa.nombre, sum(erp.analfabetos + erp.alfabetos) tt
from erpm erp, departamento depto, municipio muni, pais ppa
where erp.sexo='F' and erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto
and depto.pais=ppa.id_pais  
group by ppa.id_pais,ppa.nombre
order by ppa.nombre) tot
where erp.sexo='F' and erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto
and depto.pais=ppa.id_pais and ppa.id_pais=tot.id_pais  
group by ppa.nombre, depto.nombre,tot.tt
order by ppa.nombre, total desc


----CONSULTA 4
select ppa.id_pais, ppa.nombre, sum(erp.analfabetos + erp.alfabetos)
from pais ppa, erpm erp,municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=ppa.id_pais
group by ppa.id_pais, ppa.nombre
order by ppa.nombre

select pa.nombre, sum(er.analfabetos) total_votos,sum(er.alfabetos) total_alf
from erpm er, pais pa,departamento ddepto, municipio mmuni
where er.municipio=mmuni.id_municipio and mmuni.departamento=ddepto.id_depto and ddepto.pais=pa.id_pais 
group by pa.nombre
-- 0 filas , sin el having para mostrar que funciona
select pa.nombre, sum(er.analfabetos) total_votos, round((sum(er.analfabetos::numeric)*100/tt.tot::numeric)::numeric,2) porcentaje
from erpm er, pais pa,departamento ddepto, municipio mmuni, (select ppa.id_pais, ppa.nombre, sum(erp.analfabetos + erp.alfabetos) tot
from pais ppa, erpm erp,municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=ppa.id_pais
group by ppa.id_pais, ppa.nombre
order by ppa.nombre) tt
where er.municipio=mmuni.id_municipio and mmuni.departamento=ddepto.id_depto and ddepto.pais=pa.id_pais and pa.id_pais=tt.id_pais
group by pa.nombre,tt.tot
having round((sum(er.analfabetos::numeric)*100/tt.tot::numeric)::numeric,2)>round((sum(er.alfabetos::numeric)*100/tt.tot::numeric)::numeric,2)


--CONSULTA 5 
select pa.nombre,depto.nombre,muni.id_municipio, muni.nombre, sum(erp.analfabetos + erp.alfabetos)
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre
order by muni.id_municipio

select pa.nombre,depto.nombre,muni.id_municipio, muni.nombre,ppar.partido, sum(erp.analfabetos + erp.alfabetos)
from erpm erp, municipio muni, departamento depto, pais pa,partido ppar
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and erp.partido=ppar.id_partido
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre,ppar.partido
order by muni.id_municipio




select pa.nombre,depto.nombre,muni.id_municipio, muni.nombre,ppar.partido, sum(erp.analfabetos + erp.alfabetos),
round((sum(erp.analfabetos + erp.alfabetos)::numeric*100/tt.tot::numeric)::numeric,2) porcentaje
from erpm erp, municipio muni, departamento depto, pais pa,partido ppar, (select pa.nombre,depto.nombre,muni.id_municipio, 
muni.nombre, sum(erp.analfabetos + erp.alfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre
order by muni.id_municipio) tt
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and 
erp.partido=ppar.id_partido and muni.id_municipio=tt.id_municipio
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre,ppar.partido,tt.tot
order by muni.id_municipio,porcentaje desc




SELECT
  * 
FROM (
  SELECT
    ROW_NUMBER() OVER (PARTITION BY id_municipio ORDER BY porcentaje desc) AS r,
    t.*
  FROM
    (select pa.nombre pais,depto.nombre departamento,muni.id_municipio, muni.nombre,ppar.partido, sum(erp.analfabetos + erp.alfabetos),
round((sum(erp.analfabetos + erp.alfabetos)::numeric*100/tt.tot::numeric)::numeric,2) porcentaje
from erpm erp, municipio muni, departamento depto, pais pa,partido ppar, (select pa.nombre,depto.nombre,muni.id_municipio, 
muni.nombre, sum(erp.analfabetos + erp.alfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre
order by muni.id_municipio) tt
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and 
erp.partido=ppar.id_partido and muni.id_municipio=tt.id_municipio
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre,ppar.partido,tt.tot
order by muni.id_municipio,porcentaje desc ) t) x
WHERE
  x.r <= 1;

-----------------------------FINAL CONSULTA 5
with tab as (
SELECT
  * 
FROM (
  SELECT
    ROW_NUMBER() OVER (PARTITION BY id_municipio ORDER BY porcentaje desc) AS r,
    t.*
  FROM
    (select pa.nombre pais,depto.nombre departamento,muni.id_municipio, muni.nombre,ppar.partido, sum(erp.analfabetos + erp.alfabetos),
round((sum(erp.analfabetos + erp.alfabetos)::numeric*100/tt.tot::numeric)::numeric,2) porcentaje
from erpm erp, municipio muni, departamento depto, pais pa,partido ppar, (select pa.nombre,depto.nombre,muni.id_municipio, 
muni.nombre, sum(erp.analfabetos + erp.alfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre
order by muni.id_municipio) tt
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and 
erp.partido=ppar.id_partido and muni.id_municipio=tt.id_municipio
group by pa.nombre,depto.nombre,muni.id_municipio, muni.nombre,ppar.partido,tt.tot
order by muni.id_municipio,porcentaje desc ) t) x
WHERE
  x.r <= 1)
select tt.pais, tt.partido, count(tt.partido)
from tab tt
group by tt.pais,tt.partido



----CONSULTA 6

select pa.nombre pais, reg.nombre region,ra.nombre, sum(erp.analfabetos + alfabetos) votos
from erpm erp, pais pa, departamento depto, municipio muni, region reg, raza ra
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.region=reg.id_region and depto.pais=pa.id_pais
and erp.raza=ra.id_raza
group by  pa.nombre, reg.nombre,ra.nombre
order by pais,region, votos desc

SELECT
  * 
FROM (
  SELECT
    ROW_NUMBER() OVER (PARTITION BY pais,region ORDER BY votos desc) AS r,
    t.*
  FROM
    (select pa.nombre pais, reg.nombre region,ra.nombre, sum(erp.analfabetos + alfabetos) votos
from erpm erp, pais pa, departamento depto, municipio muni, region reg, raza ra
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.region=reg.id_region and depto.pais=pa.id_pais
and erp.raza=ra.id_raza
group by  pa.nombre, reg.nombre,ra.nombre
order by pais,region, votos desc ) t) x
WHERE
  x.r <= 1;
-----------------------FINAL CONSULTA 6
  with ttab as
  (SELECT
  * 
FROM (
  SELECT
    ROW_NUMBER() OVER (PARTITION BY pais,region ORDER BY votos desc) AS r,
    t.*
  FROM
    (select pa.nombre pais, reg.nombre region,ra.nombre, sum(erp.analfabetos + alfabetos) votos
from erpm erp, pais pa, departamento depto, municipio muni, region reg, raza ra
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.region=reg.id_region and depto.pais=pa.id_pais
and erp.raza=ra.id_raza
group by  pa.nombre, reg.nombre,ra.nombre
order by pais,region, votos desc ) t) x
WHERE
  x.r <= 1)
  select pais,region, votos
  from ttab
  where nombre='INDIGENAS'




  -----CONSULTA 7



  select depto.id_depto, depto.nombre departamento, sum(erp.analfabetos + erp.alfabetos) total_votos
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto
group by  depto.id_depto,depto.nombre
order by depto.id_depto


select mujeres.id_depto, hombres.departamento, mujeres.votos_f,round((mujeres.votos_f::numeric*100/tot.total_votos::numeric)::numeric,2) porcentaje_f, hombres.votos_m
from (
select depto.id_depto, depto.nombre departamento,erp.sexo, sum(erp.universitario) votos_f
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and erp.sexo='F'
group by  depto.id_depto,depto.nombre,erp.sexo
order by depto.id_depto
) mujeres, (
select depto.id_depto, depto.nombre departamento,erp.sexo, sum(erp.universitario) votos_m
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and erp.sexo='M'
group by  depto.id_depto,depto.nombre,erp.sexo
order by depto.id_depto) hombres, (select depto.id_depto, depto.nombre departamento, 
sum(erp.analfabetos + erp.alfabetos) total_votos
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto
group by  depto.id_depto,depto.nombre
order by depto.id_depto) tot
where mujeres.id_depto=hombres.id_depto and 


-------FINAL CONSULTA 7

select totales.id_depto, parcial.departamento, parcial.votos_f mujeres, 
round((parcial.votos_f::numeric*100/totales.total_votos::numeric)::numeric,2) porc_mujeres,parcial.votos_m hombres, 
round((parcial.votos_m::numeric*100/totales.total_votos::numeric)::numeric,2) porc_hombres
from (
select mujeres.id_depto, hombres.departamento, mujeres.votos_f, hombres.votos_m
from (
select depto.id_depto, depto.nombre departamento,erp.sexo, sum(erp.universitario) votos_f
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and erp.sexo='F'
group by  depto.id_depto,depto.nombre,erp.sexo
order by depto.id_depto
) mujeres, (
select depto.id_depto, depto.nombre departamento,erp.sexo, sum(erp.universitario) votos_m
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and erp.sexo='M'
group by  depto.id_depto,depto.nombre,erp.sexo
order by depto.id_depto) hombres
where mujeres.id_depto=hombres.id_depto) parcial, 
(select depto.id_depto, depto.nombre departamento, sum(erp.analfabetos + erp.alfabetos) total_votos
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto
group by  depto.id_depto,depto.nombre
order by depto.id_depto
) totales
where totales.id_depto=parcial.id_depto
group by totales.id_depto, parcial.departamento, parcial.votos_f,totales.total_votos,parcial.votos_m
having round((parcial.votos_f::numeric*100/totales.total_votos::numeric)::numeric,2)>round((parcial.votos_m::numeric*100/totales.total_votos::numeric)::numeric,2)
order by totales.id_depto



----CONSULTA 8


select ppa.nombre pais, ddepto.nombre departamento, sum(er.analfabetos + er.alfabetos) tot
from erpm er, municipio mmuni, departamento ddepto, pais ppa
where er.municipio=mmuni.id_municipio and mmuni.departamento=ddepto.id_depto and ddepto.pais=ppa.id_pais and ppa.nombre='GUATEMALA'
and ddepto.nombre != 'Guatemala'
group by ppa.nombre, ddepto.nombre
having sum(er.analfabetos + er.alfabetos)>(select sum(erp.alfabetos + erp.analfabetos) vot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.nombre='Guatemala' and depto.pais=pa.id_pais
and pa.nombre='GUATEMALA'
)




----CONUSULTA 9


select pa.nombre pais, reg.nombre, depto.nombre, sum(erp.alfabetos + erp.analfabetos)
from erpm erp, municipio muni, departamento depto, region reg, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.region=reg.id_region and depto.pais=pa.id_pais
group by pa.nombre, reg.nombre, depto.nombre

--------------FINAL CONSULTA 9
with taa as
(select pa.nombre pais, reg.nombre region, depto.nombre, sum(erp.alfabetos + erp.analfabetos) tot
from erpm erp, municipio muni, departamento depto, region reg, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.region=reg.id_region and depto.pais=pa.id_pais
group by pa.nombre, reg.nombre, depto.nombre
)
select taa.pais,taa.region, round(avg(tot)::numeric,2)
from taa
group by taa.pais,taa.region
order by taa.pais, taa.region


-----CONSULTA 10


select substring(trim(muni.nombre::text) from 1 for 1) letra, sum(er.analfabetos + er.alfabetos)
from erpm er, municipio muni
where er.municipio=muni.id_municipio
group by letra
order by letra


---CONSULTA 11

select pa.id_pais, pa.nombre,muni.id_municipio, muni.nombre,par.partido, sum(erp.analfabetos + erp.alfabetos) tot
from erpm erp, municipio muni, partido par,departamento depto, pais pa
where erp.municipio=muni.id_municipio and erp.partido=par.id_partido and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais, pa.nombre,muni.id_municipio, muni.nombre,par.partido
order by pa.nombre,muni.nombre, tot desc


-------------------FINAL CONSULTA 11
SELECT
  * 
FROM (
  SELECT
    ROW_NUMBER() OVER (PARTITION BY id_pais,pais,id_municipio,municipio ORDER BY tot desc) AS r,
    t.*
  FROM
    (select pa.id_pais, pa.nombre pais,muni.id_municipio, muni.nombre municipio,par.partido, sum(erp.analfabetos + erp.alfabetos) tot
from erpm erp, municipio muni, partido par,departamento depto, pais pa
where erp.municipio=muni.id_municipio and erp.partido=par.id_partido and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais, pa.nombre,muni.id_municipio, muni.nombre,par.partido
order by pa.nombre,muni.nombre, tot desc) t) x
WHERE
  x.r <= 2;



  -------------------CONSULTA 12


  select pa.id_pais, pa.nombre, sum(erp.primaria) primaria, sum(erp.n_medio) medio, sum(erp.universitario) unniversitario
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais, pa.nombre



------CONSULTA 13

select pa.id_pais, pa.nombre, ra.nombre raza, sum(erp.analfabetos + erp.alfabetos) votos, 
round((sum(erp.analfabetos + erp.alfabetos)::numeric*100/tot.vot::numeric)::numeric,2) total
from erpm erp, municipio muni, departamento depto, pais pa,raza ra,
(select pa.id_pais, pa.nombre, sum(erp.analfabetos + erp.alfabetos) vot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais, pa.nombre) tot
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and erp.raza=ra.id_raza
and tot.id_pais=pa.id_pais
group by pa.id_pais, pa.nombre, ra.nombre,tot.vot
order by pa.id_pais, total




----------------------------CONSULTA 14


select xx.id_pais,xx.nombre, max(tot)-min(tot) diferencia
from (select pa.id_pais, pa.nombre, par.partido, sum (erp.analfabetos + erp.alfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa, partido par
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and erp.partido=par.id_partido
and par.pais=pa.id_pais
group by pa.id_pais,pa.nombre, par.partido
order by pa.id_pais, pa.nombre, tot
) xx
group by xx.id_pais,xx.nombre
order by diferencia desc





---------------CONSULTA 15





select tab.municipios, count(tab.nombre) departamentos, sum(votos)
from (select depto.id_depto, depto.nombre, count(distinct erp.municipio) municipios, sum(erp.analfabetos + erp.alfabetos) votos
from erpm erp, municipio muni, departamento depto
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto
group by depto.id_depto, depto.nombre
order by municipios) tab
group by tab.municipios




---------CONSULTA 16


select pa.id_pais,pa.nombre, muni.nombre municipio, sum(erp.primaria)
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais,pa.nombre, muni.nombre




select pa.id_pais,pa.nombre, muni.nombre municipio, sum(erp.alfabetos) total
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais,pa.nombre, muni.nombre

-----------------------FINAL CONSULTA 16
select pa.id_pais,pa.nombre, muni.nombre municipio, sum(erp.primaria) votos, round((sum(erp.primaria)::numeric*100/tt.tot::numeric)::numeric,2) porcentaje 
from erpm erp, municipio muni, departamento depto, pais pa,
(select pa.id_pais,pa.nombre,muni.id_municipio, muni.nombre municipio, sum(erp.alfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais,pa.nombre,muni.id_municipio, muni.nombre) tt
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and tt.id_pais=pa.id_pais
and muni.id_municipio=tt.id_municipio
group by pa.id_pais,pa.nombre, muni.nombre,tt.tot
having round((sum(erp.primaria)::numeric*100/tt.tot::numeric)::numeric,2)>33
order by pa.id_pais


-------------------CONSULTA 17


select pa.id_pais,pa.nombre, muni.nombre municipio, sum(erp.analfabetos) votos, round((sum(erp.analfabetos)::numeric*100/tt.tot::numeric)::numeric,2) porcentaje 
from erpm erp, municipio muni, departamento depto, pais pa,
(select pa.id_pais,pa.nombre,muni.id_municipio, muni.nombre municipio, sum(erp.alfabetos + erp.analfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais,pa.nombre,muni.id_municipio, muni.nombre) tt
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and tt.id_pais=pa.id_pais
and muni.id_municipio=tt.id_municipio
group by pa.id_pais,pa.nombre, muni.nombre,tt.tot
having round((sum(erp.analfabetos)::numeric*100/tt.tot::numeric)::numeric,2)>33
order by pa.id_pais




------------------CONSULTA 18



select pa.id_pais,pa.nombre,depto.nombre depto, muni.nombre municipio, sum(erp.universitario) votos, round((sum(erp.universitario)::numeric*100/tt.tot::numeric)::numeric,2) porcentaje 
from erpm erp, municipio muni, departamento depto, pais pa,
(select pa.id_pais,pa.nombre,muni.id_municipio, muni.nombre municipio, sum(erp.alfabetos + erp.analfabetos) tot
from erpm erp, municipio muni, departamento depto, pais pa
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais
group by pa.id_pais,pa.nombre,muni.id_municipio, muni.nombre) tt
where erp.municipio=muni.id_municipio and muni.departamento=depto.id_depto and depto.pais=pa.id_pais and tt.id_pais=pa.id_pais
and muni.id_municipio=tt.id_municipio
group by pa.id_pais,pa.nombre,depto.nombre, muni.nombre,tt.tot
having round((sum(erp.universitario)::numeric*100/tt.tot::numeric)::numeric,2)>33
order by pa.id_pais



