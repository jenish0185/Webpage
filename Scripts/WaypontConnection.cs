// WaypointConnection.cs
using System.Collections.Generic;
using UnityEngine;

public class WaypointConnection : MonoBehaviour
{
    public List<Transform> waypoints;

    void OnDrawGizmos()
    {
        Gizmos.color = Color.yellow;
        for (int i = 0; i < waypoints.Count; i++)
        {
            if (i + 1 < waypoints.Count)
            {
                Gizmos.DrawLine(waypoints[i].position, waypoints[i + 1].position);
            }
        }
    }
}