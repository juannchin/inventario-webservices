/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/GUIForms/JFrame.java to edit this template
 */
package vistas;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import javax.swing.JComboBox;
import javax.swing.JOptionPane;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;
import javax.swing.table.DefaultTableModel;
import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.HttpClientBuilder;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONObject;

/**
 *
 * @author micro
 */
public class FrmProductos extends javax.swing.JFrame {

    /**
     * Creates new form FrmProductos
     */
    public FrmProductos() {

        initComponents();

        cargarDatos();

        this.setLocationRelativeTo(null);

    }

// Método para obtener la lista de marcas desde la API
    public Map<String, Integer> obtenerMarcas() {
        Map<String, Integer> marcas = new HashMap<>();

        try {
            // Establecer la URL de la API de listarMarcas
            URL url = new URL("http://localhost/WS/listarMarcas.php");

            // Realizar la conexión HTTP GET
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("GET");

            // Leer la respuesta JSON
            BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            String line;
            StringBuilder response = new StringBuilder();
            while ((line = reader.readLine()) != null) {
                response.append(line);
            }
            reader.close();

            // Parsear la respuesta JSON y obtener las categorías
            JSONArray jsonArray = new JSONArray(response.toString());
            for (int i = 0; i < jsonArray.length(); i++) {
                JSONObject jsonObject = jsonArray.getJSONObject(i);
                int id = jsonObject.getInt("id");
                String nombre = jsonObject.getString("nombre");
                marcas.put(nombre, id);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return marcas;
    }

    public Map<String, Integer> obtenerCategorias() {
        Map<String, Integer> categorias = new HashMap<>();

        try {
            // Establecer la URL de la API de listarCategorias
            URL url = new URL("http://localhost/WS/listarCategorias.php");

            // Realizar la conexión HTTP GET
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("GET");

            // Leer la respuesta JSON
            BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            String line;
            StringBuilder response = new StringBuilder();
            while ((line = reader.readLine()) != null) {
                response.append(line);
            }
            reader.close();

            // Parsear la respuesta JSON y obtener las categorías
            JSONArray jsonArray = new JSONArray(response.toString());
            for (int i = 0; i < jsonArray.length(); i++) {
                JSONObject jsonObject = jsonArray.getJSONObject(i);
                int id = jsonObject.getInt("id");
                String nombre = jsonObject.getString("nombre");
                categorias.put(nombre, id);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return categorias;
    }

    private void cargarDatos() {

        try {

            // Obtener las marcas y categorías
            Map<String, Integer> categorias = obtenerCategorias();
            Map<String, Integer> marcas = obtenerMarcas();

            // Llenar el ComboBox de categorías
            for (Map.Entry<String, Integer> entry : categorias.entrySet()) {
                String nombreCategoria = entry.getKey();
                comboCategorias.addItem(nombreCategoria);
            }

            for (Map.Entry<String, Integer> entry : marcas.entrySet()) {
                String nombreMarca = entry.getKey();
                comboMarcas.addItem(nombreMarca);
            }

            // Establecer la URL de la API
            URL url = new URL("http://localhost/WS/listarProductos.php");

            // Realizar la conexión HTTP
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestMethod("GET");

            // Obtener la respuesta JSON de la API
            BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            StringBuilder response = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) {
                response.append(line);
            }
            reader.close();

            // Parsear la respuesta JSON
            JSONArray jsonArray = new JSONArray(response.toString());

            // Crear el modelo de tabla
            DefaultTableModel tableModel = new DefaultTableModel();
            tableModel.addColumn("ID");
            tableModel.addColumn("Nombre");
            tableModel.addColumn("Categoria");
            tableModel.addColumn("Marca");
            tableModel.addColumn("Cantidad");
            tableModel.addColumn("Valor");
            tableModel.addColumn("Caducidad");

            // Llenar el modelo de tabla con los datos del JSON
            for (int i = 0; i < jsonArray.length(); i++) {
                JSONObject jsonObject = jsonArray.getJSONObject(i);
                String id = jsonObject.getString("id");
                String nombre = jsonObject.getString("nombre");
                String categoria = jsonObject.getString("categoria");
                String marca = jsonObject.getString("marca");
                String cantidad = jsonObject.getString("cantidad");
                String valor = jsonObject.getString("valor");
                String caducidad = jsonObject.getString("caducidad");

                tableModel.addRow(new Object[]{id, nombre, categoria, marca, cantidad, valor, caducidad});
            }

            // Establecer el modelo de tabla en el JTable
            TablaProductos.setModel(tableModel);

            //Apertura del Metodo para seleccionar filas y llenar los campos con los datos seleccionados en el JTable
            TablaProductos.getSelectionModel().addListSelectionListener(new ListSelectionListener() {
                public void valueChanged(ListSelectionEvent event) {
                    // Verificar que no haya eventos de selección en curso y que la selección no esté vacía
                    if (!event.getValueIsAdjusting() && TablaProductos.getSelectedRow() != -1) {
                        int filaSeleccionada = TablaProductos.getSelectedRow();
                        String id = (String) TablaProductos.getValueAt(filaSeleccionada, 0);
                        String nombre = (String) TablaProductos.getValueAt(filaSeleccionada, 1);
                        String categoria = (String) TablaProductos.getValueAt(filaSeleccionada, 2);
                        String marca = (String) TablaProductos.getValueAt(filaSeleccionada, 3);
                        String cantidad = (String) TablaProductos.getValueAt(filaSeleccionada, 4);
                        String valor = (String) TablaProductos.getValueAt(filaSeleccionada, 5);
                        String caducidad = (String) TablaProductos.getValueAt(filaSeleccionada, 6);

                        // Mostrar los datos en los campos de texto
                        idTxt.setText(id);
                        nombreTxt.setText(nombre);
                        cantidadTxt.setText(cantidad);
                        valorTxt.setText(valor);

                        // Seleccionar el valor correcto en el ComboBox de categoría
                        comboCategorias.setSelectedItem(categoria);

                        // Seleccionar el valor correcto en el ComboBox de marca
                        comboMarcas.setSelectedItem(marca);

                        try {
                            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                            Date fechaCaducidad = dateFormat.parse(caducidad);
                            CaducidadDate.setDate(fechaCaducidad);
                        } catch (Exception e) {
                            e.printStackTrace();
                        }

                    }
                }
            });
            //fin del metodo de seleccionar fila y llenar campos en JTable

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">                          
    private void initComponents() {

        bg = new javax.swing.JPanel();
        jScrollPane2 = new javax.swing.JScrollPane();
        TablaProductos = new javax.swing.JTable();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        idTxt = new javax.swing.JTextField();
        jLabel3 = new javax.swing.JLabel();
        estadoTxt = new javax.swing.JTextField();
        jLabel4 = new javax.swing.JLabel();
        nombreTxt = new javax.swing.JTextField();
        jLabel5 = new javax.swing.JLabel();
        jLabel6 = new javax.swing.JLabel();
        jLabel7 = new javax.swing.JLabel();
        jLabel8 = new javax.swing.JLabel();
        jLabel9 = new javax.swing.JLabel();
        cantidadTxt = new javax.swing.JTextField();
        valorTxt = new javax.swing.JTextField();
        CaducidadDate = new com.toedter.calendar.JDateChooser();
        btnRegresar = new javax.swing.JButton();
        btnInsertar = new javax.swing.JButton();
        btnActualizar = new javax.swing.JButton();
        btnEliminar = new javax.swing.JButton();
        btnLimpiar = new javax.swing.JButton();
        comboCategorias = new javax.swing.JComboBox<>();
        comboMarcas = new javax.swing.JComboBox<>();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);
        setLocationByPlatform(true);
        setResizable(false);

        bg.setBackground(new java.awt.Color(255, 255, 255));

        TablaProductos.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {

            },
            new String [] {
                "", "", "", "", "", "", ""
            }
        ));
        TablaProductos.setFocusable(false);
        TablaProductos.setSelectionBackground(new java.awt.Color(153, 0, 153));
        jScrollPane2.setViewportView(TablaProductos);

        jLabel1.setFont(new java.awt.Font("Segoe UI Black", 0, 18)); // NOI18N
        jLabel1.setText("Lista de Productos");

        jLabel2.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel2.setText("ID:");

        idTxt.setBackground(new java.awt.Color(255, 153, 153));
        idTxt.setRequestFocusEnabled(false);

        jLabel3.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel3.setText("Estado:");

        jLabel4.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel4.setText("Nombre:");

        jLabel5.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel5.setText("Categoria:");

        jLabel6.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel6.setText("Cantidad:");

        jLabel7.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel7.setText("Valor: $");

        jLabel8.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel8.setText("Marca:");

        jLabel9.setFont(new java.awt.Font("Segoe UI", 1, 12)); // NOI18N
        jLabel9.setText("Caducidad:");

        CaducidadDate.setDateFormatString("yyyy-MM-dd");

        btnRegresar.setBackground(new java.awt.Color(153, 0, 153));
        btnRegresar.setFont(new java.awt.Font("Segoe UI", 1, 14)); // NOI18N
        btnRegresar.setForeground(new java.awt.Color(255, 255, 255));
        btnRegresar.setText("Regresar");
        btnRegresar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnRegresarActionPerformed(evt);
            }
        });

        btnInsertar.setBackground(new java.awt.Color(0, 102, 102));
        btnInsertar.setFont(new java.awt.Font("Segoe UI", 1, 14)); // NOI18N
        btnInsertar.setForeground(new java.awt.Color(255, 255, 255));
        btnInsertar.setText("Registrar");
        btnInsertar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnInsertarActionPerformed(evt);
            }
        });

        btnActualizar.setBackground(new java.awt.Color(153, 102, 255));
        btnActualizar.setFont(new java.awt.Font("Segoe UI", 1, 14)); // NOI18N
        btnActualizar.setForeground(new java.awt.Color(255, 255, 255));
        btnActualizar.setText("Actualizar");
        btnActualizar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnActualizarActionPerformed(evt);
            }
        });

        btnEliminar.setBackground(new java.awt.Color(204, 0, 51));
        btnEliminar.setFont(new java.awt.Font("Segoe UI", 1, 14)); // NOI18N
        btnEliminar.setForeground(new java.awt.Color(255, 255, 255));
        btnEliminar.setText("Eliminar");
        btnEliminar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnEliminarActionPerformed(evt);
            }
        });

        btnLimpiar.setFont(new java.awt.Font("Segoe UI", 1, 14)); // NOI18N
        btnLimpiar.setText("Limpiar");
        btnLimpiar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnLimpiarActionPerformed(evt);
            }
        });

        comboCategorias.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Seleccione una categoria" }));

        comboMarcas.setModel(new javax.swing.DefaultComboBoxModel<>(new String[] { "Seleccione una marca" }));

        javax.swing.GroupLayout bgLayout = new javax.swing.GroupLayout(bg);
        bg.setLayout(bgLayout);
        bgLayout.setHorizontalGroup(
            bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(bgLayout.createSequentialGroup()
                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(bgLayout.createSequentialGroup()
                        .addGap(26, 26, 26)
                        .addComponent(jLabel1, javax.swing.GroupLayout.PREFERRED_SIZE, 194, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(bgLayout.createSequentialGroup()
                        .addGap(68, 68, 68)
                        .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 830, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addGroup(bgLayout.createSequentialGroup()
                                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel3)
                                    .addComponent(jLabel2))
                                .addGap(18, 18, 18)
                                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                                    .addComponent(idTxt, javax.swing.GroupLayout.DEFAULT_SIZE, 90, Short.MAX_VALUE)
                                    .addComponent(estadoTxt))
                                .addGap(85, 85, 85)
                                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(jLabel5)
                                    .addComponent(jLabel4)
                                    .addComponent(jLabel8))
                                .addGap(20, 20, 20)
                                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addComponent(nombreTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 190, javax.swing.GroupLayout.PREFERRED_SIZE)
                                    .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                                        .addComponent(comboMarcas, javax.swing.GroupLayout.Alignment.LEADING, 0, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                        .addComponent(comboCategorias, javax.swing.GroupLayout.Alignment.LEADING, 0, 170, Short.MAX_VALUE)))
                                .addGap(95, 95, 95)
                                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                    .addGroup(bgLayout.createSequentialGroup()
                                        .addComponent(jLabel9)
                                        .addGap(18, 18, 18)
                                        .addComponent(CaducidadDate, javax.swing.GroupLayout.PREFERRED_SIZE, 130, javax.swing.GroupLayout.PREFERRED_SIZE))
                                    .addGroup(bgLayout.createSequentialGroup()
                                        .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                            .addComponent(jLabel6)
                                            .addComponent(jLabel7))
                                        .addGap(26, 26, 26)
                                        .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                                            .addComponent(valorTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE)
                                            .addComponent(cantidadTxt, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE)))))
                            .addGroup(bgLayout.createSequentialGroup()
                                .addComponent(btnRegresar, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(18, 18, 18)
                                .addComponent(btnLimpiar, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                                .addComponent(btnInsertar, javax.swing.GroupLayout.PREFERRED_SIZE, 97, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(18, 18, 18)
                                .addComponent(btnActualizar, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(18, 18, 18)
                                .addComponent(btnEliminar, javax.swing.GroupLayout.PREFERRED_SIZE, 100, javax.swing.GroupLayout.PREFERRED_SIZE)))))
                .addContainerGap(72, Short.MAX_VALUE))
        );
        bgLayout.setVerticalGroup(
            bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, bgLayout.createSequentialGroup()
                .addGap(25, 25, 25)
                .addComponent(jLabel1)
                .addGap(38, 38, 38)
                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel2)
                    .addComponent(idTxt, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel4)
                    .addComponent(nombreTxt, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel6)
                    .addComponent(cantidadTxt, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel3)
                    .addComponent(estadoTxt, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(jLabel5)
                    .addComponent(jLabel7)
                    .addComponent(valorTxt, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(comboCategorias, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE))
                .addGap(18, 18, 18)
                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(bgLayout.createSequentialGroup()
                        .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addGroup(bgLayout.createSequentialGroup()
                                .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                    .addComponent(jLabel8)
                                    .addComponent(jLabel9))
                                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, bgLayout.createSequentialGroup()
                                .addGap(0, 0, Short.MAX_VALUE)
                                .addComponent(comboMarcas, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addGap(40, 40, 40)))
                        .addComponent(jScrollPane2, javax.swing.GroupLayout.PREFERRED_SIZE, 280, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(18, 18, 18)
                        .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(btnLimpiar, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                            .addGroup(bgLayout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                                .addComponent(btnRegresar, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addComponent(btnInsertar, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addComponent(btnActualizar, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)
                                .addComponent(btnEliminar, javax.swing.GroupLayout.PREFERRED_SIZE, 30, javax.swing.GroupLayout.PREFERRED_SIZE)))
                        .addGap(41, 41, 41))
                    .addGroup(bgLayout.createSequentialGroup()
                        .addComponent(CaducidadDate, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(bg, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(bg, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
        );

        pack();
    }// </editor-fold>                        


    private void btnInsertarActionPerformed(java.awt.event.ActionEvent evt) {                                            

        // Obtener los valores de los campos de texto para insertar
        String nombre = nombreTxt.getText();
        String categoriaSeleccionada = comboCategorias.getSelectedItem().toString();
        int idCategoriaSeleccionada = obtenerCategorias().get(categoriaSeleccionada);
        String marcaSeleccionada = comboMarcas.getSelectedItem().toString();
        int idMarcaSeleccionada = obtenerMarcas().get(marcaSeleccionada);
        String cantidad = cantidadTxt.getText();
        String valor = valorTxt.getText();
        Date caducidadDate = CaducidadDate.getDate();
        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        String caducidad = dateFormat.format(caducidadDate);
        String estado = estadoTxt.getText();

        // Crear la solicitud HTTP POST
        HttpClient httpClient = HttpClientBuilder.create().build();
        HttpPost httpPost = new HttpPost("http://localhost/WS/insertProducto.php");

        try {
            // Agregar los parámetros de la solicitud POST
            List<NameValuePair> params = new ArrayList<>();
            params.add(new BasicNameValuePair("nombre", nombre));
            params.add(new BasicNameValuePair("id_categoria", String.valueOf(idCategoriaSeleccionada)));
            params.add(new BasicNameValuePair("id_marca", String.valueOf(idMarcaSeleccionada)));
            params.add(new BasicNameValuePair("cantidad", cantidad));
            params.add(new BasicNameValuePair("valor", valor));
            params.add(new BasicNameValuePair("caducidad", caducidad));
            params.add(new BasicNameValuePair("estado", estado));
            httpPost.setEntity(new UrlEncodedFormEntity(params));

            // Ejecutar la solicitud HTTP POST
            HttpResponse response = httpClient.execute(httpPost);
            HttpEntity entity = response.getEntity();
            String jsonResponse = EntityUtils.toString(entity);

            // Procesar la respuesta
            System.out.println(jsonResponse);
            cargarDatos();
            //Vaciar los campos
            idTxt.setText("");
            nombreTxt.setText("");
            cantidadTxt.setText("");
            valorTxt.setText("");
            CaducidadDate.setDate(null);
            comboCategorias.setSelectedItem("Seleccione una categoria");
            comboMarcas.setSelectedItem("Seleccione una marca");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }                                           

    private void btnRegresarActionPerformed(java.awt.event.ActionEvent evt) {                                            
        Dashboard vista = new Dashboard();
        vista.setVisible(true);
        dispose();
    }                                           

    private void btnActualizarActionPerformed(java.awt.event.ActionEvent evt) {                                              

        // Obtener los valores actualizados de los campos de texto
        String productoId = idTxt.getText();
        String nuevoNombre = nombreTxt.getText();
        String categoriaSeleccionada = comboCategorias.getSelectedItem().toString();
        int idCategoriaSeleccionada = obtenerCategorias().get(categoriaSeleccionada);
        String marcaSeleccionada = comboMarcas.getSelectedItem().toString();
        int idMarcaSeleccionada = obtenerMarcas().get(marcaSeleccionada);
        String nuevaCantidad = cantidadTxt.getText();
        String nuevoValor = valorTxt.getText();
        Date nuevaCaducidadDate = CaducidadDate.getDate();
        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        String nuevaCaducidad = dateFormat.format(nuevaCaducidadDate);
        String nuevoEstado = estadoTxt.getText();

        // Crear la solicitud HTTP POST
        HttpClient httpClient = HttpClientBuilder.create().build();
        HttpPost httpPost = new HttpPost("http://localhost/WS/updateProducto.php");

        try {

            // Agregar los parámetros de la solicitud POST
            List<NameValuePair> params = new ArrayList<>();
            params.add(new BasicNameValuePair("id", productoId));
            params.add(new BasicNameValuePair("nombre", nuevoNombre));
            params.add(new BasicNameValuePair("id_categoria", String.valueOf(idCategoriaSeleccionada)));
            params.add(new BasicNameValuePair("id_marca", String.valueOf(idMarcaSeleccionada)));
            params.add(new BasicNameValuePair("cantidad", nuevaCantidad));
            params.add(new BasicNameValuePair("valor", nuevoValor));
            params.add(new BasicNameValuePair("caducidad", nuevaCaducidad));
            params.add(new BasicNameValuePair("estado", nuevoEstado));
            httpPost.setEntity(new UrlEncodedFormEntity(params));

            // Ejecutar la solicitud HTTP POST
            HttpResponse response = httpClient.execute(httpPost);
            HttpEntity entity = response.getEntity();
            String jsonResponse = EntityUtils.toString(entity);

            // Procesar la respuesta
            System.out.println(jsonResponse);
            cargarDatos();
            //Vaciar los campos
            idTxt.setText("");
            nombreTxt.setText("");
            cantidadTxt.setText("");
            valorTxt.setText("");
            CaducidadDate.setDate(null);
            comboCategorias.setSelectedItem("Seleccione una categoria");
            comboMarcas.setSelectedItem("Seleccione una marca");

        } catch (Exception e) {
            e.printStackTrace();
        }


    }                                             

    private void btnEliminarActionPerformed(java.awt.event.ActionEvent evt) {                                            
        // Obtener el ID del producto a eliminar
        String productoId = obtenerProductoIdSeleccionado();

        // Crear la solicitud HTTP POST
        HttpClient httpClient = HttpClientBuilder.create().build();
        HttpPost request = new HttpPost("http://localhost/WS/deleteProducto.php");

        try {

            // Agregar los parámetros de la solicitud POST
            List<NameValuePair> params = new ArrayList<>();
            params.add(new BasicNameValuePair("producto_id", productoId));
            params.add(new BasicNameValuePair("nuevo_estado", "eliminado"));
            request.setEntity(new UrlEncodedFormEntity(params));

            // Ejecutar la solicitud HTTP POST
            HttpResponse response = httpClient.execute(request);
            HttpEntity entity = response.getEntity();
            String jsonResponse = EntityUtils.toString(entity);

            // Procesar la respuesta
            JOptionPane.showConfirmDialog(this, "¿Esta seguro de eliminar?");
            System.out.println(jsonResponse);
            cargarDatos();
            //Vaciar los campos
            idTxt.setText("");
            nombreTxt.setText("");
            cantidadTxt.setText("");
            valorTxt.setText("");
            CaducidadDate.setDate(null);
            comboCategorias.setSelectedItem("Seleccione una categoria");
            comboMarcas.setSelectedItem("Seleccione una marca");

        } catch (Exception e) {
            e.printStackTrace();
        }

    }                                           

    private void btnLimpiarActionPerformed(java.awt.event.ActionEvent evt) {                                           
        //Vaciar los campos
        idTxt.setText("");
        nombreTxt.setText("");
        cantidadTxt.setText("");
        valorTxt.setText("");
        CaducidadDate.setDate(null);
        comboCategorias.setSelectedItem("Seleccione una categoria");
        comboMarcas.setSelectedItem("Seleccione una marca");
    }                                          

    private String obtenerProductoIdSeleccionado() {
        // Obtener el ID del producto seleccionado en la tabla
        int filaSeleccionada = TablaProductos.getSelectedRow();
        return (String) TablaProductos.getValueAt(filaSeleccionada, 0);
    }

    // ...
    /**
     * @param args the command line arguments
     */
    public static void main(String args[]) {
        /* Set the Nimbus look and feel */
        //<editor-fold defaultstate="collapsed" desc=" Look and feel setting code (optional) ">
        /* If Nimbus (introduced in Java SE 6) is not available, stay with the default look and feel.
         * For details see http://download.oracle.com/javase/tutorial/uiswing/lookandfeel/plaf.html 
         */
        try {
            for (javax.swing.UIManager.LookAndFeelInfo info : javax.swing.UIManager.getInstalledLookAndFeels()) {
                if ("Nimbus".equals(info.getName())) {
                    javax.swing.UIManager.setLookAndFeel(info.getClassName());
                    break;

                }
            }
        } catch (ClassNotFoundException ex) {
            java.util.logging.Logger.getLogger(FrmProductos.class
                    .getName()).log(java.util.logging.Level.SEVERE, null, ex);

        } catch (InstantiationException ex) {
            java.util.logging.Logger.getLogger(FrmProductos.class
                    .getName()).log(java.util.logging.Level.SEVERE, null, ex);

        } catch (IllegalAccessException ex) {
            java.util.logging.Logger.getLogger(FrmProductos.class
                    .getName()).log(java.util.logging.Level.SEVERE, null, ex);

        } catch (javax.swing.UnsupportedLookAndFeelException ex) {
            java.util.logging.Logger.getLogger(FrmProductos.class
                    .getName()).log(java.util.logging.Level.SEVERE, null, ex);
        }
        //</editor-fold>

        /* Create and display the form */
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new FrmProductos().setVisible(true);
            }
        });
    }

    // Variables declaration - do not modify                     
    private com.toedter.calendar.JDateChooser CaducidadDate;
    private javax.swing.JTable TablaProductos;
    private javax.swing.JPanel bg;
    private javax.swing.JButton btnActualizar;
    private javax.swing.JButton btnEliminar;
    private javax.swing.JButton btnInsertar;
    private javax.swing.JButton btnLimpiar;
    private javax.swing.JButton btnRegresar;
    private javax.swing.JTextField cantidadTxt;
    private javax.swing.JComboBox<String> comboCategorias;
    private javax.swing.JComboBox<String> comboMarcas;
    private javax.swing.JTextField estadoTxt;
    private javax.swing.JTextField idTxt;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel5;
    private javax.swing.JLabel jLabel6;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel8;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JScrollPane jScrollPane2;
    private javax.swing.JTextField nombreTxt;
    private javax.swing.JTextField valorTxt;
    // End of variables declaration                   
}
